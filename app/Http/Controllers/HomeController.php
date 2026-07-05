<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Display the landing page with featured products and categories.
     */
    public function index()
    {
        $categories = Category::take(3)->get();
        $featuredProducts = Product::latest()->take(8)->get();
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

        $products = $query->paginate(12);
        $categories = Category::all();

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
}
