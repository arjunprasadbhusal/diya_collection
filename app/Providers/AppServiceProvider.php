<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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

        View::composer('layouts.master', function ($view) {
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

            $view->with('categories', Cache::remember(
                'layout.categories',
                now()->addMinutes(10),
                fn () => Category::orderBy('name')->get()
            ));
        });
    }
}
