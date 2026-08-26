<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->take(8)
            ->get();

        $featuredProducts = Product::where('status', 'published')
            ->with(['category', 'vendor'])
            ->latest()
            ->take(8)
            ->get();

        $totalProducts = Product::where('status', 'published')->count();
        $totalCustomers = User::count();
        $averageRating = (float) (Product::where('status', 'published')->where('avg_rating', '>', 0)->avg('avg_rating') ?: 4.8);

        return view('frontend.home', compact(
            'categories',
            'featuredProducts',
            'totalProducts',
            'totalCustomers',
            'averageRating'
        ));
    }

    public function shop(Request $request)
    {
        $query = Product::where('status', 'published')->with(['category', 'vendor']);

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category)->orWhere('id', $request->category);
            });
        }

        if ($request->filled('q')) {
            $search = $request->q;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        // Sorting
        match ($request->get('sort', 'latest')) {
            'price_low' => $query->orderBy('price', 'asc'),
            'price_high' => $query->orderBy('price', 'desc'),
            'rating' => $query->orderBy('avg_rating', 'desc'),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->withCount('products')->get();

        return view('frontend.products.index', compact('products', 'categories'));
    }

    public function productShow(string $slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'published')
            ->with(['category', 'vendor', 'reviews.user'])
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'published')
            ->take(4)
            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }

    // category page
    public function categories()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        return view('frontend.categories.index', compact('categories'));
    }

    /**
     * Category show page
     */
    public function categoryShow(string $slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = Product::where('category_id', $category->id)
            ->where('status', 'published')
            ->with(['category', 'vendor'])
            ->latest()
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        return view('frontend.products.index', compact('products', 'categories', 'category'));
    }
     public function sale()
    {
        $products = Product::where('status', 'published')
            ->whereNotNull('discount_price')
            ->whereColumn('discount_price', '<', 'price')
            ->with(['category', 'vendor'])
            ->latest()
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        return view('frontend.products.index', compact('products', 'categories'));
    }

}
