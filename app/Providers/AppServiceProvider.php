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
        // Render uses HTTPS, while local development normally uses http://localhost.
        // Forcing HTTPS locally makes refreshed image URLs point to https://localhost,
        // where no HTTPS server is running.
        if (str_starts_with((string) config('app.url'), 'https://')) {
            URL::forceScheme('https');
        }

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

            $categoryIds = Cache::remember(
                'layout.category_ids',
                now()->addMinutes(10),
                fn () => Category::orderBy('name')->pluck('id')->all()
            );

            $positions = array_flip(array_map('strval', $categoryIds));

            $categories = $categoryIds === []
                ? collect()
                : Category::whereIn('id', $categoryIds)
                    ->get()
                    ->sortBy(fn (Category $category) => $positions[(string) $category->id] ?? PHP_INT_MAX)
                    ->values();

            $view->with('categories', $categories);
        });
    }
}
