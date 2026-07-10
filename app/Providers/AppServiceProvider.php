<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Force HTTPS scheme for all generated URLs (fixes mixed-content CSS issue on Render)
        URL::forceScheme('https');

        View::composer('*', function ($view) {
            $cartCount = 0;

            if (Auth::check()) {
                $cartCount = (int) Cart::where('user_id', Auth::id())->sum('quantity');
            } else {
                $cart = session()->get('cart', []);

                foreach ($cart as $item) {
                    $cartCount += (int) ($item['quantity'] ?? 0);
                }
            }

            $view->with('cartCount', $cartCount);

            $view->with('categories', Category::orderBy('name')->get());

            $view->with([
                'homeCategories' => Category::take(3)->get(),
                'featuredProducts' => Product::with('category')->latest()->take(4)->get(),
                'spotlightProduct' => Product::with('category')->latest()->first(),
                'highlightCategory' => Category::latest()->first(),
            ]);
        });
    }
}