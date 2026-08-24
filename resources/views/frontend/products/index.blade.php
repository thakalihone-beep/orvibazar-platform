{{-- @extends('layouts.app')

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
 --}}




 <!-- resources/views/product-detail.blade.php -->
@extends('layouts.guest')

@section('title', $product->name . ' - OrviBazar')

@section('content')
<div style="padding: var(--spacing-2xl) 0; background: var(--color-bg-light); min-height: 100vh;">
    <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

        <!-- Breadcrumb -->
        <div style="display: flex; align-items: center; gap: var(--spacing-sm); font-size: var(--font-size-sm); padding: var(--spacing-md) 0; color: var(--color-text-muted); flex-wrap: wrap;">
            <a href="{{ route('home') }}" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                <i class="fas fa-home"></i> Home
            </a>
            <span style="color: var(--color-text-muted);">/</span>
            <a href="{{ route('shop') }}" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">Shop</a>
            <span style="color: var(--color-text-muted);">/</span>
            @if($product->category)
                <a href="{{ route('category.show', $product->category->slug) }}" style="color: var(--color-text-muted); text-decoration: none; transition: color var(--transition-fast);">
                    {{ $product->category->name }}
                </a>
                <span style="color: var(--color-text-muted);">/</span>
            @endif
            <span style="color: var(--color-primary); font-weight: var(--font-weight-medium);">{{ $product->name }}</span>
        </div>

        <!-- Product Detail -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-2xl); padding: var(--spacing-2xl) 0; background: white; border-radius: var(--radius-2xl); box-shadow: var(--shadow-sm); padding: var(--spacing-2xl);">

            <!-- Gallery -->
            <div>
                <!-- Main Image -->
                <div style="border-radius: var(--radius-lg); overflow: hidden; background: var(--color-off-white); position: relative;">
                    <img id="mainImage" src="{{ $product->image_url }}" alt="{{ $product->name }}" style="width: 100%; height: auto; aspect-ratio: 1/1; object-fit: cover; transition: transform var(--transition-slow);">

                    <!-- Sale Badge -->
                    @if($product->is_on_sale)
                        <span style="position: absolute; top: var(--spacing-md); right: var(--spacing-md); background: var(--color-sale-bg); color: white; padding: 6px 14px; border-radius: var(--radius-full); font-size: var(--font-size-sm); font-weight: var(--font-weight-bold); text-transform: uppercase; z-index: 1;">
                            <i class="fas fa-tag"></i> SALE
                        </span>
                    @endif
                </div>

                <!-- Thumbnails -->
                @if($product->gallery_images && count($product->gallery_images) > 0)
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: var(--spacing-sm); margin-top: var(--spacing-sm);">
                        @foreach($product->gallery_images as $index => $image)
                            <div onclick="changeImage(this)" style="border-radius: var(--radius-sm); overflow: hidden; border: 2px solid {{ $index === 0 ? 'var(--color-primary)' : 'transparent' }}; cursor: pointer; transition: all var(--transition-fast);">
                                <img src="{{ $image }}" alt="Product Image {{ $index + 1 }}" style="width: 100%; aspect-ratio: 1/1; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Info -->
            <div>
                <!-- Product Name -->
                <h1 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-sm);">
                    {{ $product->name }}
                </h1>

                <!-- Rating & Reviews -->
                <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-md); flex-wrap: wrap;">
                    <div style="display: flex; gap: 2px;">
                        @php
                            $avgRating = $product->average_rating ?? 0;
                        @endphp
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($avgRating))
                                <span style="color: var(--color-star); font-size: var(--font-size-md);">★</span>
                            @elseif($i == ceil($avgRating) && ($avgRating - floor($avgRating)) >= 0.5)
                                <span style="color: var(--color-star); font-size: var(--font-size-md);">★</span>
                            @else
                                <span style="color: var(--color-star-empty); font-size: var(--font-size-md);">★</span>
                            @endif
                        @endfor
                    </div>
                    <span style="color: var(--color-text-muted); font-size: var(--font-size-sm);">({{ number_format($product->reviews_count ?? 0) }} reviews)</span>
                    <span style="color: var(--color-text-muted); font-size: var(--font-size-sm);">|</span>
                    <span style="color: var(--color-success); font-size: var(--font-size-sm);">
                        <i class="fas fa-check-circle"></i>
                        @if($product->stock_status === 'in-stock')
                            In Stock
                        @elseif($product->stock_status === 'low-stock')
                            Low Stock
                        @else
                            Out of Stock
                        @endif
                    </span>
                </div>

                <!-- Price -->
                <div style="margin-bottom: var(--spacing-md);">
                    @if($product->is_on_sale)
                        <span style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-bold); color: var(--color-sale);">
                            NRs. {{ number_format($product->discount_price, 2) }}
                        </span>
                        <span style="font-size: var(--font-size-lg); color: var(--color-text-muted); text-decoration: line-through; margin-left: var(--spacing-sm); font-weight: var(--font-weight-regular);">
                            NRs. {{ number_format($product->price, 2) }}
                        </span>
                    @else
                        <span style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-bold); color: var(--color-primary);">
                            NRs. {{ number_format($product->price, 2) }}
                        </span>
                    @endif
                </div>

                <!-- Description -->
                <div style="margin-bottom: var(--spacing-lg);">
                    <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                        {{ $product->description ?? 'No description available for this product.' }}
                    </p>
                </div>

                <!-- Product Details -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-sm); margin-bottom: var(--spacing-lg);">
                    @if($product->sku)
                        <div style="font-size: var(--font-size-sm); color: var(--color-text-muted);">
                            <strong>SKU:</strong> {{ $product->sku }}
                        </div>
                    @endif
                    @if($product->category)
                        <div style="font-size: var(--font-size-sm); color: var(--color-text-muted);">
                            <strong>Category:</strong> <a href="{{ route('category.show', $product->category->slug) }}" style="color: var(--color-primary); text-decoration: none;">{{ $product->category->name }}</a>
                        </div>
                    @endif
                    <div style="font-size: var(--font-size-sm); color: var(--color-text-muted);">
                        <strong>Stock:</strong> {{ $product->stock_qty > 0 ? $product->stock_qty . ' units' : 'Out of Stock' }}
                    </div>
                    @if($product->tags && count($product->tags) > 0)
                        <div style="font-size: var(--font-size-sm); color: var(--color-text-muted); grid-column: 1 / -1;">
                            <strong>Tags:</strong>
                            @foreach($product->tags as $tag)
                                <span style="display: inline-block; background: var(--color-off-white); padding: 2px 10px; border-radius: var(--radius-full); margin: 2px 4px 2px 0; font-size: var(--font-size-xs);">
                                    {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Quantity & Add to Cart -->
                @if($product->stock_status !== 'out-of-stock')
                    <div style="display: flex; gap: var(--spacing-md); align-items: center; margin-bottom: var(--spacing-lg); flex-wrap: wrap;">
                        <div style="display: inline-flex; align-items: center; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); overflow: hidden;">
                            <button onclick="updateQuantity(-1)" style="background: var(--color-bg-light); border: none; padding: 10px 16px; cursor: pointer; font-size: var(--font-size-lg); transition: background var(--transition-fast); min-width: 44px;">
                                <i class="fas fa-minus"></i>
                            </button>
                            <input id="quantityInput" type="number" value="1" min="1" max="{{ $product->stock_qty }}" style="width: 60px; text-align: center; border: none; border-left: 1px solid var(--color-border-light); border-right: 1px solid var(--color-border-light); padding: 10px 0; font-size: var(--font-size-base); font-weight: var(--font-weight-medium); background: white; outline: none;">
                            <button onclick="updateQuantity(1)" style="background: var(--color-bg-light); border: none; padding: 10px 16px; cursor: pointer; font-size: var(--font-size-lg); transition: background var(--transition-fast); min-width: 44px;">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>

                        <button onclick="addToCart()" style="flex: 1; padding: 14px 32px; background: var(--color-accent); color: var(--color-primary); border: none; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-base); display: inline-flex; align-items: center; justify-content: center; gap: var(--spacing-sm); min-width: 200px;">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    </div>

                    <!-- Wishlist & Compare -->
                    <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
                        <button onclick="addToWishlist()" style="padding: 10px 20px; border: 1px solid var(--color-border-light); background: white; border-radius: var(--radius-md); cursor: pointer; transition: all var(--transition-fast); display: inline-flex; align-items: center; gap: var(--spacing-sm);">
                            <i class="fas fa-heart" style="color: var(--color-text-muted);"></i> Add to Wishlist
                        </button>
                        <button onclick="compareProduct()" style="padding: 10px 20px; border: 1px solid var(--color-border-light); background: white; border-radius: var(--radius-md); cursor: pointer; transition: all var(--transition-fast); display: inline-flex; align-items: center; gap: var(--spacing-sm);">
                            <i class="fas fa-exchange-alt" style="color: var(--color-text-muted);"></i> Compare
                        </button>
                    </div>
                @else
                    <div style="padding: var(--spacing-lg); background: var(--color-off-white); border-radius: var(--radius-md); text-align: center;">
                        <i class="fas fa-times-circle" style="font-size: 48px; color: var(--color-error);"></i>
                        <h3 style="color: var(--color-error); margin-top: var(--spacing-sm);">Out of Stock</h3>
                        <p style="color: var(--color-text-muted);">This product is currently unavailable. Please check back later.</p>
                        <button onclick="notifyMe()" style="padding: 10px 24px; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-md); cursor: pointer; margin-top: var(--spacing-sm);">
                            <i class="fas fa-bell"></i> Notify Me When Available
                        </button>
                    </div>
                @endif

                <!-- Share & Social -->
                <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-lg); border-top: 1px solid var(--color-border-light);">
                    <p style="font-size: var(--font-size-sm); color: var(--color-text-muted); margin-bottom: var(--spacing-sm);">
                        <i class="fas fa-share-alt"></i> Share this product:
                    </p>
                    <div style="display: flex; gap: var(--spacing-sm);">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: #1877f2; color: white; border-radius: 50%; text-decoration: none; transition: all var(--transition-fast);">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($product->name) }}" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: #1da1f2; color: white; border-radius: 50%; text-decoration: none; transition: all var(--transition-fast);">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: #e4405f; color: white; border-radius: 50%; text-decoration: none; transition: all var(--transition-fast);">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($product->name . ' - ' . url()->current()) }}" target="_blank" style="display: inline-flex; align-items: center; justify-content: center; width: 36px; height: 36px; background: #25d366; color: white; border-radius: 50%; text-decoration: none; transition: all var(--transition-fast);">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if(isset($relatedProducts) && count($relatedProducts) > 0)
            <section style="padding: var(--spacing-2xl) 0;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-xl);">
                    <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold);">
                        <i class="fas fa-arrow-right" style="color: var(--color-accent);"></i> Related Products
                    </h2>
                    <a href="{{ route('shop') }}" style="color: var(--color-primary); font-weight: var(--font-weight-medium); text-decoration: none; display: inline-flex; align-items: center; gap: var(--spacing-xs);">
                        View All <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: var(--spacing-lg);">
                    @foreach($relatedProducts as $related)
                        <x-product-card
                            :product="$related"
                            image="{{ $related->image_url }}"
                            title="{{ $related->name }}"
                            price="{{ $related->price }}"
                            discount_price="{{ $related->discount_price }}"
                            rating="{{ $related->average_rating ?? 0 }}"
                            reviews="{{ $related->reviews_count ?? 0 }}"
                            stock="{{ $related->stock_status }}"
                            sale="{{ $related->is_on_sale }}"
                            link="{{ route('product.show', $related->slug) }}"
                            product_id="{{ $related->id }}"
                        />
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Reviews Section -->
        <section style="padding: var(--spacing-2xl) 0; border-top: 1px solid var(--color-border-light);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-xl);">
                <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold);">
                    <i class="fas fa-comments" style="color: var(--color-accent);"></i> Customer Reviews
                </h2>
                <button onclick="openReviewModal()" style="padding: 10px 24px; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-md); font-weight: var(--font-weight-semibold); cursor: pointer; transition: all var(--transition-fast);">
                    <i class="fas fa-pen"></i> Write a Review
                </button>
            </div>

            <!-- Review Summary -->
            <div style="display: grid; grid-template-columns: 1fr 2fr; gap: var(--spacing-2xl); margin-bottom: var(--spacing-xl);">
                <div style="text-align: center; padding: var(--spacing-lg); background: var(--color-off-white); border-radius: var(--radius-lg);">
                    <span style="font-size: var(--font-size-4xl); font-weight: var(--font-weight-bold); color: var(--color-primary);">
                        {{ number_format($product->average_rating ?? 0, 1) }}
                    </span>
                    <div style="display: flex; justify-content: center; gap: 2px; margin: var(--spacing-xs) 0;">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= floor($product->average_rating ?? 0))
                                <span style="color: var(--color-star); font-size: var(--font-size-xl);">★</span>
                            @elseif($i == ceil($product->average_rating ?? 0) && (($product->average_rating ?? 0) - floor($product->average_rating ?? 0)) >= 0.5)
                                <span style="color: var(--color-star); font-size: var(--font-size-xl);">★</span>
                            @else
                                <span style="color: var(--color-star-empty); font-size: var(--font-size-xl);">★</span>
                            @endif
                        @endfor
                    </div>
                    <p style="color: var(--color-text-muted); font-size: var(--font-size-sm);">Based on {{ number_format($product->reviews_count ?? 0) }} reviews</p>
                </div>

                <div>
                    @php
                        $ratingDistribution = $product->reviews->groupBy('rating')->map->count() ?? collect();
                    @endphp
                    @for($i = 5; $i >= 1; $i--)
                        @php
                            $count = $ratingDistribution[$i] ?? 0;
                            $total = $product->reviews_count ?? 1;
                            $percentage = $total > 0 ? ($count / $total) * 100 : 0;
                        @endphp
                        <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-xs);">
                            <span style="font-size: var(--font-size-sm); min-width: 30px;">{{ $i }}★</span>
                            <div style="flex: 1; height: 8px; background: var(--color-border-light); border-radius: var(--radius-full);">
                                <div style="width: {{ $percentage }}%; height: 100%; background: var(--color-star); border-radius: var(--radius-full);"></div>
                            </div>
                            <span style="font-size: var(--font-size-sm); color: var(--color-text-muted); min-width: 50px;">{{ $count }}</span>
                        </div>
                    @endfor
                </div>
            </div>

            <!-- Review List -->
            <div>
                @forelse($product->reviews->take(5) ?? [] as $review)
                    <div style="padding: var(--spacing-lg) 0; border-bottom: 1px solid var(--color-border-light);">
                        <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: var(--spacing-xs); flex-wrap: wrap;">
                            <div>
                                <strong style="font-size: var(--font-size-md);">{{ $review->user->name ?? 'Anonymous' }}</strong>
                                <div style="display: flex; gap: 2px; margin-top: 4px;">
                                    @for($i = 1; $i <= 5; $i++)
                                        <span style="color: {{ $i <= $review->rating ? 'var(--color-star)' : 'var(--color-star-empty)' }};">★</span>
                                    @endfor
                                </div>
                            </div>
                            <span style="color: var(--color-text-muted); font-size: var(--font-size-sm);">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        @if($review->comment)
                            <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-top: var(--spacing-sm);">
                                {{ $review->comment }}
                            </p>
                        @endif
                        <div style="display: flex; gap: var(--spacing-sm); margin-top: var(--spacing-sm);">
                            <button onclick="helpfulReview({{ $review->id }})" style="padding: 4px 12px; background: var(--color-off-white); border: none; border-radius: var(--radius-sm); font-size: var(--font-size-xs); cursor: pointer; transition: all var(--transition-fast);">
                                <i class="fas fa-thumbs-up"></i> Helpful ({{ $review->helpful_count ?? 0 }})
                            </button>
                        </div>
                    </div>
                @empty
                    <div style="text-align: center; padding: var(--spacing-2xl) 0; color: var(--color-text-muted);">
                        <i class="fas fa-comment-slash" style="font-size: 48px; margin-bottom: var(--spacing-md); display: block;"></i>
                        <p>No reviews yet. Be the first to review this product!</p>
                    </div>
                @endforelse

                @if(($product->reviews_count ?? 0) > 5)
                    <div style="text-align: center; margin-top: var(--spacing-lg);">
                        <button onclick="loadMoreReviews()" style="padding: 12px 32px; background: transparent; color: var(--color-primary); border: 2px solid var(--color-primary); border-radius: var(--radius-md); font-weight: var(--font-weight-semibold); cursor: pointer; transition: all var(--transition-fast);">
                            Load More Reviews
                        </button>
                    </div>
                @endif
            </div>
        </section>
    </div>
</div>

<script>
// ============================================
// IMAGE GALLERY
// ============================================
function changeImage(element) {
    // Get the image source from the clicked thumbnail
    const imgSrc = element.querySelector('img').src;
    // Update the main image
    document.getElementById('mainImage').src = imgSrc;

    // Update active state
    const thumbnails = document.querySelectorAll('.thumbnails > div');
    thumbnails.forEach(thumb => {
        thumb.style.borderColor = 'transparent';
    });
    element.style.borderColor = 'var(--color-primary)';
}

// ============================================
// QUANTITY CONTROLS
// ============================================
function updateQuantity(change) {
    const input = document.getElementById('quantityInput');
    let value = parseInt(input.value) || 1;
    const max = parseInt(input.max) || 99;
    value += change;

    if (value < 1) value = 1;
    if (value > max) value = max;

    input.value = value;
}

// ============================================
// ADD TO CART
// ============================================
function addToCart() {
    const quantity = document.getElementById('quantityInput').value;
    const price = {{ $product->is_on_sale ? $product->discount_price : $product->price }};
    const total = (price * quantity).toFixed(2);

    // Show feedback
    const btn = event.target.closest('button');
    const originalText = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
    btn.disabled = true;

    setTimeout(() => {
        btn.innerHTML = '<i class="fas fa-check"></i> Added!';
        btn.style.background = 'var(--color-success)';
        btn.style.color = 'white';

        // Update cart count
        const cartCount = document.getElementById('cartCount');
        if (cartCount) {
            const currentCount = parseInt(cartCount.textContent) || 0;
            cartCount.textContent = currentCount + parseInt(quantity);
        }

        showToast('success', `Added ${quantity} item(s) to cart!`);

        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            btn.style.background = 'var(--color-accent)';
            btn.style.color = 'var(--color-primary)';
        }, 2000);
    }, 1000);
}

// ============================================
// WISHLIST
// ============================================
function addToWishlist() {
    const btn = event.target.closest('button');
    const icon = btn.querySelector('i');

    if (icon.style.color === 'var(--color-accent)') {
        icon.style.color = 'var(--color-text-muted)';
        showToast('info', 'Removed from wishlist');
    } else {
        icon.style.color = 'var(--color-accent)';
        showToast('success', 'Added to wishlist! ❤️');

        // Update wishlist count
        const wishlistCount = document.getElementById('wishlistCount');
        if (wishlistCount) {
            const currentCount = parseInt(wishlistCount.textContent) || 0;
            wishlistCount.textContent = currentCount + 1;
        }
    }
}

// ============================================
// COMPARE PRODUCT
// ============================================
function compareProduct() {
    showToast('info', 'Product added to comparison list!');
}

// ============================================
// NOTIFY ME
// ============================================
function notifyMe() {
    showToast('success', 'You will be notified when this product is back in stock!');
}

// ============================================
// REVIEW MODAL
// ============================================
function openReviewModal() {
    showToast('info', 'Review form will open here!');
}

// ============================================
// HELPFUL REVIEW
// ============================================
function helpfulReview(reviewId) {
    const btn = event.target.closest('button');
    const text = btn.textContent.trim();
    const match = text.match(/\d+/);
    let count = match ? parseInt(match[0]) : 0;
    count++;
    btn.innerHTML = `<i class="fas fa-thumbs-up"></i> Helpful (${count})`;
    btn.disabled = true;
    btn.style.opacity = '0.7';
    showToast('success', 'Thank you for your feedback!');
}

// ============================================
// LOAD MORE REVIEWS
// ============================================
function loadMoreReviews() {
    const btn = event.target;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
    btn.disabled = true;

    setTimeout(() => {
        btn.innerHTML = 'Load More Reviews';
        btn.disabled = false;
        showToast('info', 'More reviews loaded!');
    }, 1500);
}

// ============================================
// TOAST NOTIFICATION
// ============================================
function showToast(type, message) {
    const existingToast = document.querySelector('.toast-notification');
    if (existingToast) {
        existingToast.remove();
    }

    const toast = document.createElement('div');
    toast.className = 'toast-notification';

    const colors = {
        'success': 'var(--color-success)',
        'error': 'var(--color-error)',
        'warning': 'var(--color-warning)',
        'info': 'var(--color-info)'
    };

    const icons = {
        'success': 'fa-check-circle',
        'error': 'fa-times-circle',
        'warning': 'fa-exclamation-circle',
        'info': 'fa-info-circle'
    };

    toast.style.cssText = `
        position: fixed;
        bottom: var(--spacing-xl);
        right: var(--spacing-xl);
        background: ${colors[type] || 'var(--color-primary)'};
        color: white;
        padding: var(--spacing-md) var(--spacing-lg);
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-lg);
        z-index: 9999;
        display: flex;
        align-items: center;
        gap: var(--spacing-sm);
        animation: slideInUp 0.3s ease;
        font-weight: var(--font-weight-medium);
        max-width: 400px;
        min-width: 280px;
        font-size: var(--font-size-sm);
    `;

    toast.innerHTML = `
        <i class="fas ${icons[type] || 'fa-info-circle'}" style="font-size: 20px;"></i>
        <span>${message}</span>
        <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; font-size: 18px; margin-left: auto; padding: 0 4px;">
            <i class="fas fa-times"></i>
        </button>
    `;

    document.body.appendChild(toast);

    setTimeout(() => {
        if (toast.parentElement) {
            toast.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => toast.remove(), 300);
        }
    }, 5000);
}

// ============================================
// KEYBOARD SHORTCUTS
// ============================================
document.addEventListener('keydown', function(e) {
    // Add to cart with Ctrl+Enter
    if (e.ctrlKey && e.key === 'Enter') {
        const addBtn = document.querySelector('button[onclick*="addToCart()"]');
        if (addBtn) addBtn.click();
    }

    // Quantity controls with arrow keys
    if (e.target.id === 'quantityInput') {
        if (e.key === 'ArrowUp') {
            e.preventDefault();
            updateQuantity(1);
        } else if (e.key === 'ArrowDown') {
            e.preventDefault();
            updateQuantity(-1);
        }
    }
});

// ============================================
// QUANTITY INPUT VALIDATION
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('quantityInput');
    if (quantityInput) {
        quantityInput.addEventListener('change', function() {
            let value = parseInt(this.value) || 1;
            const max = parseInt(this.max) || 99;
            if (value < 1) value = 1;
            if (value > max) value = max;
            this.value = value;
        });
    }

    // Thumbnail hover effects
    document.querySelectorAll('.thumbnails > div').forEach(thumb => {
        thumb.addEventListener('mouseenter', function() {
            this.style.borderColor = 'var(--color-primary)';
        });
        thumb.addEventListener('mouseleave', function() {
            if (!this.querySelector('img').src === document.getElementById('mainImage').src) {
                this.style.borderColor = 'transparent';
            }
        });
    });
});
</script>

<style>
/* Hover effects for related products */
.related-product:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-hover);
}

/* Thumbnail hover */
.thumbnails > div:hover {
    border-color: var(--color-primary) !important;
}

/* Add to cart button animation */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.btn-add-to-cart:active {
    animation: pulse 0.3s ease;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .product-detail {
        grid-template-columns: 1fr;
        gap: var(--spacing-xl);
    }

    .review-summary {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .product-detail {
        padding: var(--spacing-lg);
    }

    .product-detail .product-info {
        padding-top: 0;
    }

    .thumbnails {
        grid-template-columns: repeat(4, 1fr);
        gap: var(--spacing-xs);
    }

    .review-summary {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .product-detail {
        padding: var(--spacing-md);
    }

    .thumbnails {
        grid-template-columns: repeat(4, 1fr);
    }

    .quantity-selector button {
        padding: 8px 12px;
    }
}
</style>
@endsection
