<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the shopping cart.
     */
    public function index()
    {
        $cartItems = [];
        
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->with('product')->get();
        } else {
            // Handle guest session cart if needed
            $sessionCart = session()->get('cart', []);
            foreach ($sessionCart as $id => $details) {
                $cartItems[] = (object)[
                    'product_id' => $id,
                    'product' => Product::find($id),
                    'quantity' => $details['quantity']
                ];
            }
        }

        return view('cart', compact('cartItems'));
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $quantity = $request->input('quantity', 1);

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())
                            ->where('product_id', $productId)
                            ->first();

            if ($cartItem) {
                $cartItem->increment('quantity', $quantity);
            } else {
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $productId,
                    'quantity' => $quantity
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $cart[$productId] = [
                    "name" => $product->name,
                    "quantity" => $quantity,
                    "price" => $product->price,
                    "image" => $product->image
                ];
            }

            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    /**
     * Update cart item quantity.
     */
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

    /**
     * Remove an item from the cart.
     */
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
