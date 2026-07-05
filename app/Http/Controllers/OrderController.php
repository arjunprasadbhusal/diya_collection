<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.order.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,delivery,cancel',
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        if ($validated['status'] === 'cancel') {
            $this->restoreStock($order);
        }

        return back()->with('success', 'Order status updated.');
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($order->status, ['pending'])) {
            return back()->with('error', 'Order cannot be cancelled at this stage.');
        }

        DB::transaction(function () use ($order) {
            $order->update(['status' => 'cancel']);
            $this->restoreStock($order);
        });

        return back()->with('success', 'Order cancelled successfully.');
    }

    private function restoreStock(Order $order)
    {
        $items = is_array($order->items) ? $order->items : (json_decode($order->items, true) ?? []);

        foreach ($items as $item) {
            if (!empty($item['product_id'])) {
                Product::where('id', $item['product_id'])->increment('stock', $item['quantity'] ?? 1);
            }
        }
    }
}
