<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = [];

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get();
        } else {
            $sessionCart = session()->get('cart', []);
            foreach ($sessionCart as $key => $details) {
                $productId = explode('_', $key)[0];
                $product = Product::find($productId);
                if (!$product) {
                    continue;
                }

                $cartItems[] = (object) [
                    'product_id' => $productId,
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'size' => $details['size'] ?? null,
                ];
            }
        }

        return view('checkout', compact('cartItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'shipping_address_1' => 'required|string|max:255',
            'shipping_address_2' => 'nullable|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:32',
        ]);

        $cartItems = [];

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get();
        } else {
            $sessionCart = session()->get('cart', []);
            foreach ($sessionCart as $key => $details) {
                $productId = explode('_', $key)[0];
                $product = Product::find($productId);
                if (!$product) {
                    continue;
                }

                $cartItems[] = (object) [
                    'product_id' => $productId,
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'size' => $details['size'] ?? null,
                ];
            }
        }

        if (count($cartItems) === 0) {
            return redirect()->route('checkout')->with('error', 'Your bag is empty.');
        }

        $order = null;
        try {
            DB::transaction(function () use ($cartItems, $validated, &$order) {
                $productIds = collect($cartItems)->pluck('product.id')->filter()->unique()->values();
                $products = Product::whereIn('id', $productIds)->lockForUpdate()->get()->keyBy('id');

                foreach ($cartItems as $item) {
                    $product = $products->get($item->product->id);

                    if (!$product) {
                        throw new \RuntimeException('One of the selected products is no longer available.');
                    }

                    if ((int) $product->stock < (int) $item->quantity) {
                        throw new \RuntimeException('Not enough stock available for ' . $product->name . '.');
                    }
                }

                $subtotal = collect($cartItems)->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });

                $tax = $subtotal * 0.08;
                $total = $subtotal + $tax;

                $items = collect($cartItems)->map(function ($item) {
                    return [
                        'product_id' => $item->product->id,
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'size' => $item->size ?? null,
                        'image' => $item->product->image,
                    ];
                })->values()->all();

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'first_name' => $validated['first_name'],
                    'last_name' => $validated['last_name'] ?? null,
                    'email' => $validated['email'],
                    'phone' => $validated['phone'] ?? null,
                    'shipping_address_1' => $validated['shipping_address_1'],
                    'shipping_address_2' => $validated['shipping_address_2'] ?? null,
                    'shipping_city' => $validated['shipping_city'],
                    'shipping_postal_code' => $validated['shipping_postal_code'],
                    'payment_method' => 'cod',
                    'status' => 'pending',
                    'currency' => 'USD',
                    'subtotal' => $subtotal,
                    'tax' => $tax,
                    'total' => $total,
                    'items_count' => count($items),
                    'items' => $items,
                ]);

                foreach ($cartItems as $item) {
                    $products->get($item->product->id)->decrement('stock', $item->quantity);
                }

                if (Auth::check()) {
                    Cart::where('user_id', Auth::id())->delete();
                } else {
                    session()->forget('cart');
                }
            });
        } catch (\Throwable $throwable) {
            return redirect()->route('checkout')->with('error', $throwable->getMessage());
        }

        if (!$order) {
            return redirect()->route('checkout')->with('error', 'Unable to place the order right now.');
        }

        return redirect()->route('home')->with('success', 'Order placed successfully! We\'ll notify you once it ships.');
    }
}
