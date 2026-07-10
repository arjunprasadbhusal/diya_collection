<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Display the landing page with featured products and categories.
     */
    public function index()
    {
        $categoryIds = Cache::remember(
            'home.category_ids',
            now()->addMinutes(10),
            fn () => Category::latest()->take(3)->pluck('id')->all()
        );

        $featuredProductIds = Cache::remember(
            'home.featured_product_ids',
            now()->addMinutes(5),
            fn () => Product::latest()->take(8)->pluck('id')->all()
        );

        $categories = $this->categoriesByIds($categoryIds);
        $featuredProducts = $this->productsByIds($featuredProductIds);

        $highlights = [
            [
                'title' => 'Express Delivery',
                'description' => 'Complimentary on orders over $500',
            ],
            [
                'title' => 'Secure Payment',
                'description' => 'Industry-leading encryption',
            ],
            [
                'title' => 'Easy Returns',
                'description' => '30-day effortless return policy',
            ],
            [
                'title' => 'Personal Service',
                'description' => 'Bespoke assistance 24/7',
            ],
        ];
        
        return view('welcome', compact('categories', 'featuredProducts', 'highlights'));
    }

    /**
     * Display the shop page with all products.
     */
    public function shop(Request $request)
    {
        $query = Product::query();

        if ($request->has('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->has('sort')) {
            if ($request->sort == 'price_low') $query->orderBy('price', 'asc');
            if ($request->sort == 'price_high') $query->orderBy('price', 'desc');
            if ($request->sort == 'newest') $query->latest();
        } else {
            $query->latest();
        }

        $products = $query->with('category')->paginate(12);

        $categoryIds = Cache::remember(
            'shop.category_ids',
            now()->addMinutes(10),
            fn () => Category::orderBy('name')->pluck('id')->all()
        );

        $categories = $this->categoriesByIds($categoryIds);

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display a specific product.
     */
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('category')
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function searchSuggestions(Request $request)
    {
        $query = $request->get('q');

        if (!$query || strlen($query) < 2) {
            return response()->json([]);
        }

        $products = Product::with('category')
            ->where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->take(5)
            ->get()
            ->map(function ($product) {
                return [
                    'id' => $product->id,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'image' => $product->image_url,
                    'category' => $product->category->name ?? '',
                ];
            });

        return response()->json($products);
    }

    private function categoriesByIds(array $ids): Collection
    {
        if ($ids === []) {
            return collect();
        }

        $positions = array_flip(array_map('strval', $ids));

        return Category::whereIn('id', $ids)
            ->get()
            ->sortBy(fn (Category $category) => $positions[(string) $category->id] ?? PHP_INT_MAX)
            ->values();
    }

    private function productsByIds(array $ids): Collection
    {
        if ($ids === []) {
            return collect();
        }

        $positions = array_flip(array_map('strval', $ids));

        return Product::with('category')
            ->whereIn('id', $ids)
            ->get()
            ->sortBy(fn (Product $product) => $positions[(string) $product->id] ?? PHP_INT_MAX)
            ->values();
    }
}
