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
            $sessionCart = session()->get('cart', []);
            foreach ($sessionCart as $key => $details) {
                $productId = explode('_', $key)[0];
                $cartItems[] = (object)[
                    'cart_key' => $key,
                    'product_id' => $productId,
                    'product' => Product::find($productId),
                    'quantity' => $details['quantity'],
                    'size' => $details['size'] ?? null,
                ];
            }
        }

        return view('cart', compact('cartItems'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $quantity = $request->input('quantity', 1);
        $size = $request->input('size');

        if (!$size) {
            return redirect()->back()->with('error', 'Please select a size.');
        }

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $productId)
                            ->where('size', $size)
                            ->first();

            if ($cartItem) {
                return redirect()->route('products.index')->with('error', 'This item is already in your cart.');
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
                return redirect()->route('products.index')->with('error', 'This item is already in your cart.');
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

        return redirect()->route('products.index')->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        $quantity = $request->input('quantity');

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())->where('id', $id)->firstOrFail();
            $cartItem->update(['quantity' => $quantity]);
        } else {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
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
}
