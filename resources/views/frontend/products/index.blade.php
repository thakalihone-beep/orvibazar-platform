@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - OrviBazar' : 'Shop Products - OrviBazar')

@section('content')
<div class="container" style="max-width: var(--container-max, 1280px); margin: 0 auto; padding: var(--spacing-2xl, 32px) var(--container-padding, 16px);">

    <!-- Breadcrumb & Header -->
    <div style="margin-bottom: var(--spacing-2xl, 32px);">
        <div style="font-size: var(--font-size-sm, 14px); color: var(--color-text-muted, #6b7280); margin-bottom: var(--spacing-xs, 8px); display: flex; align-items: center; gap: 8px;">
            <a href="{{ route('home') }}" style="color: inherit; text-decoration: none;">Home</a>
            <span>/</span>
            @if(isset($category))
                <a href="{{ route('categories') }}" style="color: inherit; text-decoration: none;">Categories</a>
                <span>/</span>
                <span style="color: var(--color-primary, #1e293b); font-weight: 600;">{{ $category->name }}</span>
            @else
                <span style="color: var(--color-primary, #1e293b); font-weight: 600;">Shop All</span>
            @endif
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <div>
                <h1 style="font-size: var(--font-size-3xl, 28px); font-weight: 800; color: var(--color-primary, #1e293b); margin: 0;">
                    {{ isset($category) ? $category->name : (request('q') ? 'Search: "' . request('q') . '"' : 'All Products') }}
                </h1>
                <p style="color: var(--color-text-muted, #6b7280); font-size: 14px; margin-top: 4px;">
                    Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} products
                </p>
            </div>

            <!-- Sorting Dropdown -->
            <form method="GET" action="{{ url()->current() }}" id="sortForm" style="display: flex; align-items: center; gap: 8px;">
                @if(request('q'))
                    <input type="hidden" name="q" value="{{ request('q') }}">
                @endif
                @if(request('category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                @if(request('min_price'))
                    <input type="hidden" name="min_price" value="{{ request('min_price') }}">
                @endif
                @if(request('max_price'))
                    <input type="hidden" name="max_price" value="{{ request('max_price') }}">
                @endif

                <label for="sortSelect" style="font-size: 14px; color: var(--color-text-muted, #6b7280); font-weight: 500;">Sort By:</label>
                <select id="sortSelect" name="sort" onchange="document.getElementById('sortForm').submit()"
                        style="padding: 8px 14px; border: 1px solid var(--color-border-light, #e5e7eb); border-radius: var(--radius-md, 8px); background: white; font-size: 14px; color: var(--color-text-primary, #111827); outline: none; cursor: pointer;">
                    <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest Items</option>
                    <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                    <option value="rating" {{ request('sort') === 'rating' ? 'selected' : '' }}>Customer Rating</option>
                </select>
            </form>
        </div>
    </div>

    <!-- Main Layout: Sidebar + Product Grid -->
    <div style="display: grid; grid-template-columns: 260px 1fr; gap: var(--spacing-2xl, 32px); align-items: start;">

        <!-- Sidebar Filter -->
        <aside style="background: white; padding: 20px; border-radius: var(--radius-lg, 12px); box-shadow: var(--shadow-sm, 0 1px 3px rgba(0,0,0,0.08)); border: 1px solid var(--color-border-light, #e5e7eb);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 12px; border-bottom: 1px solid var(--color-border-light, #e5e7eb);">
                <h3 style="font-size: 16px; font-weight: 700; color: var(--color-primary, #1e293b); margin: 0;">
                    <i class="fas fa-filter" style="color: var(--color-accent, #f59e0b); margin-right: 6px;"></i> Filters
                </h3>
                @if(request()->hasAny(['category', 'q', 'min_price', 'max_price', 'sort']))
                    <a href="{{ route('shop') }}" style="font-size: 12px; color: var(--color-accent, #f59e0b); text-decoration: none; font-weight: 600;">Clear All</a>
                @endif
            </div>

            <!-- Categories Filter -->
            <div style="margin-bottom: 24px;">
                <h4 style="font-size: 14px; font-weight: 700; color: var(--color-text-primary, #111827); margin-bottom: 12px;">Categories</h4>
                <div style="display: flex; flex-direction: column; gap: 8px; max-height: 280px; overflow-y: auto;">
                    <a href="{{ route('shop', array_merge(request()->except('category', 'page'))) }}"
                       style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; text-decoration: none; padding: 6px 10px; border-radius: 6px; color: {{ !request('category') && !isset($category) ? 'var(--color-accent, #f59e0b)' : 'var(--color-text-muted, #6b7280)' }}; background: {{ !request('category') && !isset($category) ? '#fffbeb' : 'transparent' }}; font-weight: {{ !request('category') && !isset($category) ? '600' : '400' }};">
                        <span>All Categories</span>
                    </a>
                    @foreach($categories ?? [] as $cat)
                        @php
                            $isActive = (isset($category) && $category->id === $cat->id) || request('category') == $cat->slug || request('category') == $cat->id;
                        @endphp
                        <a href="{{ route('category.show', $cat->slug) }}"
                           style="display: flex; justify-content: space-between; align-items: center; font-size: 13px; text-decoration: none; padding: 6px 10px; border-radius: 6px; color: {{ $isActive ? 'var(--color-accent, #f59e0b)' : 'var(--color-text-muted, #6b7280)' }}; background: {{ $isActive ? '#fffbeb' : 'transparent' }}; font-weight: {{ $isActive ? '600' : '400' }}; transition: all 0.2s;">
                            <span>{{ $cat->name }}</span>
                            <span style="font-size: 11px; background: #f3f4f6; padding: 2px 6px; border-radius: 9999px; color: #6b7280;">{{ $cat->products_count ?? 0 }}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Price Range Filter Form -->
            <div>
                <h4 style="font-size: 14px; font-weight: 700; color: var(--color-text-primary, #111827); margin-bottom: 12px;">Price (NRs.)</h4>
                <form method="GET" action="{{ url()->current() }}" style="display: flex; flex-direction: column; gap: 10px;">
                    @if(request('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif

                    <div style="display: flex; gap: 8px; align-items: center;">
                        <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                               style="width: 100%; padding: 6px 8px; font-size: 13px; border: 1px solid var(--color-border-light, #e5e7eb); border-radius: 6px; outline: none;">
                        <span style="color: #9ca3af;">-</span>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                               style="width: 100%; padding: 6px 8px; font-size: 13px; border: 1px solid var(--color-border-light, #e5e7eb); border-radius: 6px; outline: none;">
                    </div>
                    <button type="submit"
                            style="width: 100%; padding: 8px; background: var(--color-primary, #1e293b); color: white; border: none; border-radius: 6px; font-size: 13px; font-weight: 600; cursor: pointer; transition: background 0.2s;">
                        Apply Filter
                    </button>
                </form>
            </div>
        </aside>

        <!-- Products Grid -->
        <div>
            @if($products->count() > 0)
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: var(--spacing-xl, 24px);">
                    @foreach($products as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div style="margin-top: var(--spacing-3xl, 40px); display: flex; justify-content: center;">
                    {{ $products->links() }}
                </div>
            @else
                <div style="text-align: center; padding: 60px 20px; background: white; border-radius: var(--radius-lg, 12px); border: 1px solid var(--color-border-light, #e5e7eb);">
                    <i class="fas fa-box-open" style="font-size: 48px; color: #d1d5db; margin-bottom: 16px;"></i>
                    <h3 style="font-size: 18px; font-weight: 700; color: var(--color-primary, #1e293b); margin-bottom: 8px;">No Products Found</h3>
                    <p style="color: var(--color-text-muted, #6b7280); font-size: 14px; margin-bottom: 20px;">We couldn't find any products matching your current filters.</p>
                    <a href="{{ route('shop') }}"
                       style="display: inline-block; padding: 10px 24px; background: var(--color-accent, #f59e0b); color: var(--color-primary, #1e293b); border-radius: 8px; font-weight: 700; text-decoration: none; font-size: 14px;">
                        Browse All Products
                    </a>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

