<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = [];
        
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        } else {
            $cartItems = $this->guestCartItems();
        }

        return view('cart', compact('cartItems'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $quantity = max(1, (int) $request->input('quantity', 1));
        $size = trim((string) $request->input('size', '')) ?: 'Standard';

        if ($product->stock < 1) {
            return back()->with('error', 'This product is currently out of stock.');
        }

        $quantity = min($quantity, $product->stock);

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $productId)
                            ->where('size', $size)
                            ->first();

            if ($cartItem) {
                $cartItem->update(['quantity' => min($product->stock, $cartItem->quantity + $quantity)]);
                return redirect()->route('cart.index')->with('success', 'Cart quantity updated.');
            }

            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $quantity,
                'size' => $size,
            ]);
        } else {
            $cart = session()->get('cart', []);
            $key = $productId . '_' . $size;

            if (isset($cart[$key])) {
                $cart[$key]['quantity'] = min($product->stock, $cart[$key]['quantity'] + $quantity);
                session()->put('cart', $cart);
                return redirect()->route('cart.index')->with('success', 'Cart quantity updated.');
            }

            $cart[$key] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "image" => $product->image,
                "size" => $size,
            ];

            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $quantity = max(1, (int) $request->input('quantity', 1));

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            $quantity = min($quantity, $cartItem->product->stock);
            $cartItem->update(['quantity' => $quantity]);
        } else {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                $productId = (int) explode('_', $id, 2)[0];
                $stock = (int) Product::whereKey($productId)->value('stock');
                $cart[$id]['quantity'] = min($quantity, $stock);
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove($id)
    {
        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            $cartItem->delete();
        } else {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }

        return redirect()->back()->with('success', 'Item removed from cart!');
    }

    private function guestCartItems(): array
    {
        $sessionCart = session()->get('cart', []);
        $productIds = collect(array_keys($sessionCart))
            ->map(fn (string $key) => (int) explode('_', $key, 2)[0])
            ->filter()
            ->unique()
            ->values();

        $products = Product::whereIn('id', $productIds)->get()->keyBy('id');

        return collect($sessionCart)
            ->map(function (array $details, string $key) use ($products) {
                $productId = (int) explode('_', $key, 2)[0];
                $product = $products->get($productId);

                if (!$product) {
                    return null;
                }

                return (object) [
                    'cart_key' => $key,
                    'product_id' => $productId,
                    'product' => $product,
                    'quantity' => $details['quantity'],
                    'size' => $details['size'] ?? null,
                ];
            })
            ->filter()
            ->values()
            ->all();
    }
}
