<!-- resources/views/components/navbar.blade.php -->
@props([
    'categories' => [],
    'allCategories' => [],
    'pages' => [],
    'settings' => [],
    'cartCount' => 0,
    'wishlistCount' => 0,
    'cartItems' => [],
    'cartTotal' => 0,
])

<nav
    style="background: var(--color-bg-header); color: var(--color-text-light); padding: 0 var(--container-padding); height: var(--header-height); display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: var(--z-header); box-shadow: var(--shadow-md);">

    <!-- Logo -->
    <a href="/"
        style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-text-light); text-decoration: none; display: flex; align-items: center; gap: var(--spacing-sm);">
        <i class="fas fa-store" style="color: var(--color-accent);"></i>
        {{ $settings['site_name'] ?? 'OrviBazar' }}
    </a>

    <!-- Search Bar -->
    <div
        style="flex: 1; max-width: 500px; margin: 0 var(--spacing-xl); display: flex; align-items: center; background: var(--color-primary-light); border-radius: var(--radius-full); overflow: hidden; transition: all var(--transition-base);">
        <input id="searchInput" type="text" placeholder="{{ $settings['search_placeholder'] ?? 'Search products...' }}"
            style="flex: 1; padding: 10px 20px; background: transparent; border: none; color: var(--color-text-light); font-size: var(--font-size-sm); outline: none;">
        <button id="searchBtn"
            style="padding: 10px 20px; background: var(--color-accent); border: none; color: var(--color-primary); cursor: pointer; transition: background var(--transition-fast);">
            <i class="fas fa-search"></i>
        </button>
    </div>

    <!-- Navigation Links -->
    <div style="display: flex; align-items: center; gap: var(--spacing-lg);">
        <!-- Categories Dropdown -->
        <div style="position: relative;" id="categoriesDropdown">
            <button id="categoriesToggle"
                style="background: transparent; border: none; color: var(--color-text-light); cursor: pointer; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-xs); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast);"
                onmouseover="this.style.background='var(--color-primary-light)'"
                onmouseout="this.style.background='transparent'">
                <i class="fas fa-bars"></i>
                Categories
                <i class="fas fa-chevron-down"
                    style="font-size: var(--font-size-xs); transition: transform var(--transition-fast);"
                    id="categoriesArrow"></i>
            </button>

            <!-- Dropdown Menu - DYNAMIC -->
            <div id="categoriesMenu"
                style="display: none; position: absolute; top: 100%; left: 0; min-width: 280px; background: white; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); padding: var(--spacing-sm) 0; margin-top: var(--spacing-xs); z-index: var(--z-dropdown); opacity: 0; transform: translateY(-10px); transition: all var(--transition-base); max-height: 500px; overflow-y: auto;">

                <div
                    style="padding: var(--spacing-xs) var(--spacing-lg); border-bottom: 1px solid var(--color-border-light); position: sticky; top: 0; background: white; z-index: 1;">
                    <input type="text" id="categorySearch" placeholder="Search categories..."
                        style="width: 100%; padding: 6px 12px; border: 1px solid var(--color-border-light); border-radius: var(--radius-sm); font-size: var(--font-size-sm); outline: none;">
                </div>

                <div id="categoryList">
                    @forelse($categories as $category)
                        <div style="position: relative;">
                            <a href="{{ route('category.show', $category->slug) }}"
                                data-category="{{ $category->slug }}"
                                style="display: flex; justify-content: space-between; align-items: center; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: all var(--transition-fast);"
                                onmouseover="this.style.background='var(--color-off-white)'"
                                onmouseout="this.style.background='transparent'">
                                <span>
                                    <i class="fas {{ $category->icon ?? 'fa-tag' }}"
                                        style="margin-right: var(--spacing-sm); width: 20px;"></i>
                                    {{ $category->name }}
                                </span>
                                <span style="color: var(--color-text-muted); font-size: var(--font-size-xs);">
                                    @if ($category->children->count() > 0)
                                        <i class="fas fa-chevron-right" style="font-size: 10px;"></i>
                                    @endif
                                    ({{ $category->products_count }})
                                </span>
                            </a>

                            <!-- Subcategories -->
                            @if ($category->children->count() > 0)
                                <div style="padding-left: var(--spacing-lg); background: var(--color-off-white);">
                                    @foreach ($category->children as $child)
                                        <a href="{{ route('category.show', $child->slug) }}"
                                            style="display: block; padding: var(--spacing-xs) var(--spacing-lg); color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: all var(--transition-fast);"
                                            onmouseover="this.style.background='white'; this.style.color='var(--color-primary)'"
                                            onmouseout="this.style.background='transparent'; this.style.color='var(--color-text-muted)'">
                                            <i class="fas {{ $child->icon ?? 'fa-circle' }}"
                                                style="font-size: 8px; margin-right: var(--spacing-sm);"></i>
                                            {{ $child->name }}
                                            <span
                                                style="float: right; font-size: var(--font-size-xs);">({{ $child->products_count }})</span>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <div style="padding: var(--spacing-md); color: var(--color-text-muted); text-align: center;">
                            No categories found
                        </div>
                    @endforelse

                    <div
                        style="border-top: 1px solid var(--color-border-light); margin: var(--spacing-xs) 0; position: sticky; bottom: 0; background: white;">
                        <a href="{{ route('categories') }}"
                            style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-accent); text-decoration: none; font-weight: var(--font-weight-medium); transition: all var(--transition-fast);"
                            onmouseover="this.style.background='var(--color-off-white)'"
                            onmouseout="this.style.background='transparent'">
                            <i class="fas fa-arrow-right" style="margin-right: var(--spacing-sm);"></i> View All
                            Categories
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dynamic Pages -->
        @foreach ($pages as $page)
            <a href="{{ route('page.show', $page->slug) }}"
                style="color: var(--color-text-light); text-decoration: none; font-size: var(--font-size-sm); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast);"
                onmouseover="this.style.background='var(--color-primary-light)'"
                onmouseout="this.style.background='transparent'">
                <i class="fas {{ $page->icon ?? 'fa-file' }}" style="margin-right: var(--spacing-xs);"></i>
                {{ $page->title }}
            </a>
        @endforeach

        <!-- Wishlist -->
        <a href="{{ route('wishlist.index') }}"
            style="color: var(--color-text-light); text-decoration: none; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-xs); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: background var(--transition-fast); position: relative;"
            onmouseover="this.style.background='var(--color-primary-light)'"
            onmouseout="this.style.background='transparent'">
            <i class="fas fa-heart"></i>
            <span id="wishlistCount"
                style="position: absolute; top: -5px; right: -5px; background: var(--color-accent); color: var(--color-primary); border-radius: var(--radius-full); font-size: 10px; padding: 2px 6px; font-weight: var(--font-weight-bold);">
                {{ $wishlistCount }}
            </span>
        </a>

        <!-- Cart Button -->
        <button id="cartToggle" onclick="toggleCart()"
            style="background: var(--color-accent); border: none; color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); cursor: pointer; font-size: var(--font-size-sm); display: flex; align-items: center; gap: var(--spacing-sm); font-weight: var(--font-weight-medium); transition: all var(--transition-base); position: relative;">
            <i class="fas fa-shopping-cart"></i>
            <span id="cartCount"
                style="background: var(--color-primary); color: var(--color-text-light); border-radius: var(--radius-full); padding: 0 8px; font-size: 12px; min-width: 20px; text-align: center;">
                {{ $cartCount }}
            </span>
        </button>

        <!-- User Actions -->
        <div style="display: flex; align-items: center; gap: var(--spacing-sm);">
            @auth
                <div style="position: relative;">
                    <button onclick="toggleUserDropdown()"
                        style="background: transparent; border: none; color: var(--color-text-light); cursor: pointer; padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); display: flex; align-items: center; gap: var(--spacing-sm);"
                        onmouseover="this.style.background='var(--color-primary-light)'"
                        onmouseout="this.style.background='transparent'">
                        <i class="fas fa-user-circle" style="font-size: var(--font-size-lg);"></i>
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down" style="font-size: var(--font-size-xs);"></i>
                    </button>
                    <div id="userDropdown"
                        style="display: none; position: absolute; right: 0; top: 100%; min-width: 180px; background: white; border-radius: var(--radius-md); box-shadow: var(--shadow-lg); padding: var(--spacing-sm) 0; margin-top: var(--spacing-xs); z-index: var(--z-dropdown);">
                        <a href="{{ route('profile') }}"
                            style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: background var(--transition-fast);"
                            onmouseover="this.style.background='var(--color-off-white)'"
                            onmouseout="this.style.background='transparent'">
                            <i class="fas fa-user" style="margin-right: var(--spacing-sm);"></i> Profile
                        </a>
                        <a href="{{ route('orders.index') }}"
                            style="display: block; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-text-primary); text-decoration: none; transition: background var(--transition-fast);"
                            onmouseover="this.style.background='var(--color-off-white)'"
                            onmouseout="this.style.background='transparent'">
                            <i class="fas fa-box" style="margin-right: var(--spacing-sm);"></i> Orders
                        </a>
                        <div style="border-top: 1px solid var(--color-border-light); margin: var(--spacing-xs) 0;"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                style="display: block; width: 100%; text-align: left; padding: var(--spacing-sm) var(--spacing-lg); color: var(--color-error); background: none; border: none; cursor: pointer; font-size: var(--font-size-sm); transition: background var(--transition-fast);"
                                onmouseover="this.style.background='var(--color-off-white)'"
                                onmouseout="this.style.background='transparent'">
                                <i class="fas fa-sign-out-alt" style="margin-right: var(--spacing-sm);"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    style="color: var(--color-text-light); text-decoration: none; font-size: var(--font-size-sm); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); transition: all var(--transition-fast); display: flex; align-items: center; gap: var(--spacing-xs);"
                    onmouseover="this.style.background='var(--color-primary-light)'"
                    onmouseout="this.style.background='transparent'">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="{{ route('register') }}"
                    style="background: var(--color-accent); color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-lg); border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-semibold); font-size: var(--font-size-sm); transition: all var(--transition-base); display: flex; align-items: center; gap: var(--spacing-xs);"
                    onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='scale(1.05)'"
                    onmouseout="this.style.background='var(--color-accent)'; this.style.transform='scale(1)'">
                    <i class="fas fa-user-plus"></i> Sign Up
                </a>
            @endauth
        </div>
    </div>

    <!-- Mobile Menu Toggle -->
    <button id="mobileToggle"
        style="display: none; background: transparent; border: none; color: var(--color-text-light); font-size: var(--font-size-xl); cursor: pointer;">
        <i class="fas fa-bars"></i>
    </button>
</nav>

<!-- Mobile Menu -->
<div id="mobileMenu"
    style="display: none; background: var(--color-primary); padding: var(--spacing-lg); position: fixed; top: var(--header-height); left: 0; width: 100%; height: calc(100vh - var(--header-height)); z-index: var(--z-dropdown); overflow-y: auto;">
    <div style="display: flex; flex-direction: column; gap: var(--spacing-md);">
        <!-- Mobile Search -->
        <div
            style="display: flex; background: var(--color-primary-light); border-radius: var(--radius-full); overflow: hidden;">
            <input id="mobileSearchInput" type="text" placeholder="Search..."
                style="flex: 1; padding: 12px 20px; background: transparent; border: none; color: var(--color-text-light); outline: none;">
            <button id="mobileSearchBtn"
                style="padding: 12px 20px; background: var(--color-accent); border: none; color: var(--color-primary);">
                <i class="fas fa-search"></i>
            </button>
        </div>

        <!-- Mobile Categories - DYNAMIC -->
        <div>
            <button id="mobileCategoriesToggle"
                style="width: 100%; background: var(--color-primary-light); border: none; color: var(--color-text-light); padding: var(--spacing-sm); border-radius: var(--radius-md); cursor: pointer; display: flex; justify-content: space-between; align-items: center; font-size: var(--font-size-base);">
                <span><i class="fas fa-bars" style="margin-right: var(--spacing-sm);"></i> Categories</span>
                <i class="fas fa-chevron-down" id="mobileCategoriesArrow"
                    style="transition: transform var(--transition-fast);"></i>
            </button>
            <div id="mobileCategoriesList" style="display: none; margin-top: var(--spacing-sm);">
                @foreach ($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}"
                        style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); border-bottom: 1px solid var(--color-primary-light);">
                        <i class="fas {{ $category->icon ?? 'fa-tag' }}"
                            style="margin-right: var(--spacing-sm);"></i>
                        {{ $category->name }}
                        <span
                            style="float: right; font-size: var(--font-size-xs); opacity: 0.7;">({{ $category->products_count }})</span>
                    </a>

                    @if ($category->children->count() > 0)
                        @foreach ($category->children as $child)
                            <a href="{{ route('category.show', $child->slug) }}"
                                style="display: block; color: var(--color-text-muted); text-decoration: none; padding: var(--spacing-xs) var(--spacing-md) var(--spacing-xs) var(--spacing-xl); border-bottom: 1px solid var(--color-primary-light); font-size: var(--font-size-sm);">
                                <i class="fas {{ $child->icon ?? 'fa-circle' }}"
                                    style="font-size: 8px; margin-right: var(--spacing-sm);"></i>
                                {{ $child->name }}
                                <span
                                    style="float: right; font-size: var(--font-size-xs); opacity: 0.7;">({{ $child->products_count }})</span>
                            </a>
                        @endforeach
                    @endif
                @endforeach

                <a href="{{ route('categories') }}"
                    style="display: block; color: var(--color-accent); text-decoration: none; padding: var(--spacing-sm) var(--spacing-md); margin-top: var(--spacing-xs); background: var(--color-primary-light); border-radius: var(--radius-md); text-align: center; font-weight: var(--font-weight-semibold);">
                    <i class="fas fa-arrow-right" style="margin-right: var(--spacing-sm);"></i> View All Categories
                </a>
            </div>
        </div>

        <!-- Mobile Pages -->
        @foreach ($pages as $page)
            <a href="{{ route('page.show', $page->slug) }}"
                style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
                <i class="fas {{ $page->icon ?? 'fa-file' }}" style="margin-right: var(--spacing-sm);"></i>
                {{ $page->title }}
            </a>
        @endforeach

        <a href="{{ route('wishlist.index') }}"
            style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-heart" style="margin-right: var(--spacing-sm);"></i> Wishlist
            <span id="mobileWishlistCount"
                style="float: right; background: var(--color-accent); color: var(--color-primary); border-radius: var(--radius-full); font-size: 10px; padding: 2px 8px; font-weight: var(--font-weight-bold);">
                {{ $wishlistCount }}
            </span>
        </a>

        <a href="/cart"
            style="color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
            <i class="fas fa-shopping-cart" style="margin-right: var(--spacing-sm);"></i> Cart
            <span id="mobileCartCount"
                style="float: right; background: var(--color-accent); color: var(--color-primary); border-radius: var(--radius-full); font-size: 10px; padding: 2px 8px; font-weight: var(--font-weight-bold);">
                {{ $cartCount }}
            </span>
        </a>

        <!-- Mobile User Actions -->
        <div style="border-top: 1px solid var(--color-primary-light); padding-top: var(--spacing-md);">
            @auth
                <div
                    style="color: var(--color-text-light); padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-user-circle" style="margin-right: var(--spacing-sm);"></i>
                    {{ Auth::user()->name }}
                </div>
                <a href="{{ route('profile') }}"
                    style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-user" style="margin-right: var(--spacing-sm);"></i> Profile
                </a>
                <a href="{{ route('orders.index') }}"
                    style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-box" style="margin-right: var(--spacing-sm);"></i> Orders
                </a>
                <form method="POST" action="{{ route('logout') }}" style="display: block; width: 100%;">
                    @csrf
                    <button type="submit"
                        style="width: 100%; background: none; border: none; color: var(--color-error); text-align: left; padding: var(--spacing-sm) 0; cursor: pointer; font-size: var(--font-size-base); border-bottom: 1px solid var(--color-primary-light);">
                        <i class="fas fa-sign-out-alt" style="margin-right: var(--spacing-sm);"></i> Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; border-bottom: 1px solid var(--color-primary-light);">
                    <i class="fas fa-sign-in-alt" style="margin-right: var(--spacing-sm);"></i> Login
                </a>
                <a href="{{ route('register') }}"
                    style="display: block; color: var(--color-text-light); text-decoration: none; padding: var(--spacing-sm) 0; background: var(--color-accent); color: var(--color-primary); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); margin-top: var(--spacing-sm); text-align: center; font-weight: var(--font-weight-semibold);">
                    <i class="fas fa-user-plus" style="margin-right: var(--spacing-sm);"></i> Sign Up
                </a>
            @endauth
        </div>
    </div>
</div>

<!-- Cart Sidebar - DYNAMIC -->
<div id="cartSidebar"
    style="position: fixed; top: 0; right: -400px; width: 380px; height: 100vh; background: white; box-shadow: var(--shadow-xl); z-index: var(--z-cart-sidebar); transition: right var(--transition-base); padding: var(--spacing-lg); display: flex; flex-direction: column;">

    <div
        style="display: flex; justify-content: space-between; align-items: center; padding-bottom: var(--spacing-md); border-bottom: 1px solid var(--color-border-light);">
        <h3 style="font-size: var(--font-size-lg);">
            <i class="fas fa-shopping-cart" style="color: var(--color-accent);"></i> Your Cart
            <span style="font-size: var(--font-size-sm); color: var(--color-text-muted);">({{ $cartCount }}
                items)</span>
        </h3>
        <button onclick="toggleCart()"
            style="background: none; border: none; font-size: var(--font-size-xl); cursor: pointer; color: var(--color-text-muted); transition: color var(--transition-fast);"
            onmouseover="this.style.color='var(--color-primary)'"
            onmouseout="this.style.color='var(--color-text-muted)'">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <div id="cartItems" style="flex: 1; overflow-y: auto; padding: var(--spacing-md) 0;">
        @if (count($cartItems) > 0)
            <div id="cartItemsList">
                @foreach ($cartItems as $item)
                    <div class="cart-item" data-product-id="{{ $item['id'] }}"
                        style="display: flex; gap: var(--spacing-md); padding: var(--spacing-md) 0; border-bottom: 1px solid var(--color-border-light); align-items: center;">
                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                            style="width: 60px; height: 60px; object-fit: cover; border-radius: var(--radius-md);">
                        <div style="flex: 1;">
                            <a href="/product/{{ $item['slug'] }}"
                                style="color: var(--color-text-primary); text-decoration: none; font-weight: var(--font-weight-medium); font-size: var(--font-size-sm);">
                                {{ $item['name'] }}
                            </a>
                            <div style="display: flex; justify-content: space-between; margin-top: var(--spacing-xs);">
                                <span style="font-weight: var(--font-weight-bold); font-size: var(--font-size-sm);">
                                    NPR {{ number_format($item['price'], 2) }}
                                </span>
                                <span style="color: var(--color-text-muted); font-size: var(--font-size-xs);">
                                    Qty: {{ $item['quantity'] }}
                                </span>
                            </div>
                        </div>
                        <button onclick="removeFromCart({{ $item['id'] }})"
                            style="background: none; border: none; color: var(--color-text-muted); cursor: pointer; padding: var(--spacing-xs); transition: color var(--transition-fast);"
                            onmouseover="this.style.color='var(--color-error)'"
                            onmouseout="this.style.color='var(--color-text-muted)'">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        @else
            <div id="emptyCart"
                style="text-align: center; padding: var(--spacing-2xl) 0; color: var(--color-text-muted);">
                <i class="fas fa-shopping-basket"
                    style="font-size: 48px; margin-bottom: var(--spacing-md); display: block; color: var(--color-border-light);"></i>
                <p style="font-size: var(--font-size-lg); font-weight: var(--font-weight-medium);">Your cart is empty
                </p>
                <p style="font-size: var(--font-size-sm);">Start shopping to add items to your cart!</p>
            </div>
        @endif
    </div>

    @if (count($cartItems) > 0)
        <div id="cartFooter" style="padding-top: var(--spacing-md); border-top: 2px solid var(--color-border-light);">
            <div
                style="display: flex; justify-content: space-between; font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-sm);">
                <span>Subtotal</span>
                <span id="cartTotal">NPR {{ number_format($cartTotal, 2) }}</span>
            </div>
            <button onclick="window.location.href='{{ route('cart.index') }}'"
                style="width: 100%; margin-top: var(--spacing-md); background: var(--color-accent); color: var(--color-primary); border: none; padding: 12px; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-base);"
                onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='scale(1.02)'"
                onmouseout="this.style.background='var(--color-accent)'; this.style.transform='scale(1)'">
                <i class="fas fa-shopping-bag"></i> View Cart
            </button>
        </div>
    @endif
</div>

<!-- Overlay -->
<div id="cartOverlay"
    style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: var(--z-overlay); opacity: 0; visibility: hidden; transition: all var(--transition-base);"
    onclick="toggleCart()"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ============================================
        // CATEGORIES DROPDOWN
        // ============================================
        const categoriesToggle = document.getElementById('categoriesToggle');
        const categoriesMenu = document.getElementById('categoriesMenu');
        const categoriesArrow = document.getElementById('categoriesArrow');
        const categorySearch = document.getElementById('categorySearch');
        const categoryLinks = document.querySelectorAll('#categoryList a[data-category]');
        let isCategoriesOpen = false;

        if (categoriesToggle) {
            categoriesToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                isCategoriesOpen = !isCategoriesOpen;
                toggleCategoriesMenu(isCategoriesOpen);
            });
        }

        function toggleCategoriesMenu(open) {
            if (!categoriesMenu || !categoriesArrow) return;
            if (open) {
                categoriesMenu.style.display = 'block';
                setTimeout(() => {
                    categoriesMenu.style.opacity = '1';
                    categoriesMenu.style.transform = 'translateY(0)';
                }, 10);
                categoriesArrow.style.transform = 'rotate(180deg)';
            } else {
                categoriesMenu.style.opacity = '0';
                categoriesMenu.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    categoriesMenu.style.display = 'none';
                }, 300);
                categoriesArrow.style.transform = 'rotate(0deg)';
            }
        }

        if (categorySearch) {
            categorySearch.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                categoryLinks.forEach(link => {
                    const text = link.textContent.toLowerCase();
                    link.closest('div').style.display = text.includes(searchTerm) ? 'block' :
                        'none';
                });
            });
        }

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('categoriesDropdown');
            if (dropdown && !dropdown.contains(e.target) && isCategoriesOpen) {
                toggleCategoriesMenu(false);
                isCategoriesOpen = false;
            }
        });

        // ============================================
        // USER DROPDOWN
        // ============================================
        window.toggleUserDropdown = function() {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown) {
                const isOpen = dropdown.style.display === 'block';
                dropdown.style.display = isOpen ? 'none' : 'block';
            }
        };

        document.addEventListener('click', function(e) {
            const dropdown = document.getElementById('userDropdown');
            const toggle = document.querySelector('[onclick="toggleUserDropdown()"]');
            if (dropdown && toggle && !toggle.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = 'none';
            }
        });

        // ============================================
        // MOBILE MENU
        // ============================================
        const mobileToggle = document.getElementById('mobileToggle');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileCategoriesToggle = document.getElementById('mobileCategoriesToggle');
        const mobileCategoriesList = document.getElementById('mobileCategoriesList');
        const mobileCategoriesArrow = document.getElementById('mobileCategoriesArrow');
        let isMobileMenuOpen = false;
        let isMobileCategoriesOpen = false;

        if (mobileToggle) {
            mobileToggle.addEventListener('click', function() {
                isMobileMenuOpen = !isMobileMenuOpen;
                mobileMenu.style.display = isMobileMenuOpen ? 'block' : 'none';
                document.body.style.overflow = isMobileMenuOpen ? 'hidden' : '';
            });
        }

        if (mobileCategoriesToggle) {
            mobileCategoriesToggle.addEventListener('click', function() {
                isMobileCategoriesOpen = !isMobileCategoriesOpen;
                mobileCategoriesList.style.display = isMobileCategoriesOpen ? 'block' : 'none';
                mobileCategoriesArrow.style.transform = isMobileCategoriesOpen ? 'rotate(180deg)' :
                    'rotate(0deg)';
            });
        }

        // Mobile search
        const mobileSearchBtn = document.getElementById('mobileSearchBtn');
        const mobileSearchInput = document.getElementById('mobileSearchInput');

        if (mobileSearchBtn && mobileSearchInput) {
            mobileSearchBtn.addEventListener('click', function() {
                const query = mobileSearchInput.value;
                if (query.trim()) {
                    window.location.href = '/shop?search=' + encodeURIComponent(query);
                }
            });

            mobileSearchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    mobileSearchBtn.click();
                }
            });
        }

        // ============================================
        // SEARCH FUNCTIONALITY
        // ============================================
        const searchBtn = document.getElementById('searchBtn');
        const searchInput = document.getElementById('searchInput');

        if (searchBtn && searchInput) {
            searchBtn.addEventListener('click', function() {
                const query = searchInput.value;
                if (query.trim()) {
                    window.location.href = '/shop?search=' + encodeURIComponent(query);
                }
            });

            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    searchBtn.click();
                }
            });
        }

        // ============================================
        // CART SIDEBAR
        // ============================================
        window.toggleCart = function() {
            const cart = document.getElementById('cartSidebar');
            const overlay = document.getElementById('cartOverlay');
            if (!cart || !overlay) return;

            const isOpen = cart.style.right === '0px';

            if (isOpen) {
                cart.style.right = '-400px';
                overlay.style.opacity = '0';
                overlay.style.visibility = 'hidden';
                document.body.style.overflow = '';
            } else {
                cart.style.right = '0px';
                overlay.style.opacity = '1';
                overlay.style.visibility = 'visible';
                document.body.style.overflow = 'hidden';
            }
        };

        // Close cart with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const cart = document.getElementById('cartSidebar');
                if (cart && cart.style.right === '0px') {
                    toggleCart();
                }
            }
        });

        // ============================================
        // CART COUNT UPDATE
        // ============================================
        window.updateCartCount = function() {
            fetch('{{ route('cart.count') }}')
                .then(response => response.json())
                .then(data => {
                    const cartCounts = document.querySelectorAll('#cartCount, #mobileCartCount');
                    cartCounts.forEach(el => {
                        if (el) el.textContent = data.cart_count;
                    });
                })
                .catch(error => console.error('Error updating cart count:', error));
        };

        // Listen for cart update events
        document.addEventListener('cartUpdated', function() {
            updateCartCount();
            // Optionally refresh the page to update cart sidebar
            // window.location.reload();
        });

        // ============================================
        // REMOVE FROM CART
        // ============================================
        window.removeFromCart = function(productId) {
            if (confirm('Remove this item from cart?')) {
                fetch('{{ route('cart.remove', ['id' => '__ID__']) }}'.replace('__ID__', productId), {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ product_id: productId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.dispatchEvent(new CustomEvent('cartUpdated'));
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        };

        // ============================================
        // RESPONSIVE HANDLING
        // ============================================
        function handleResponsive() {
            const mobileToggle = document.getElementById('mobileToggle');
            const searchBar = document.querySelector('nav > div:nth-child(2)');
            const categoriesDropdown = document.getElementById('categoriesDropdown');

            if (window.innerWidth <= 768) {
                if (mobileToggle) mobileToggle.style.display = 'block';
                if (searchBar) searchBar.style.display = 'none';
                if (categoriesDropdown) categoriesDropdown.style.display = 'none';
            } else {
                if (mobileToggle) mobileToggle.style.display = 'none';
                if (searchBar) searchBar.style.display = 'flex';
                if (categoriesDropdown) categoriesDropdown.style.display = 'block';
                if (isMobileMenuOpen) {
                    mobileMenu.style.display = 'none';
                    isMobileMenuOpen = false;
                    document.body.style.overflow = '';
                }
            }
        }

        window.addEventListener('resize', handleResponsive);
        handleResponsive();

        // Initial cart count update
        updateCartCount();
    });

    // Cart operations (for global use)
    window.Cart = {
        addToCart: function(productId, quantity = 1) {
            return fetch('{{ route('cart.add') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.dispatchEvent(new CustomEvent('cartUpdated'));
                        this.showNotification(data.message, 'success');
                    } else {
                        this.showNotification(data.message, 'error');
                    }
                    return data;
                })
                .catch(error => {
                    this.showNotification('Error adding to cart', 'error');
                    console.error('Cart error:', error);
                });
        },

        showNotification: function(message, type = 'success') {
            alert(type === 'success' ? '✓ ' + message : '✗ ' + message);
        }
    };
</script>

<style>
    /* Category dropdown hover effects */
    #categoryList a:hover {
        background: var(--color-off-white);
    }

    #categoryList a:active {
        background: var(--color-accent);
        color: var(--color-primary);
    }

    /* Cart sidebar scrollbar */
    #cartItems::-webkit-scrollbar {
        width: 4px;
    }

    #cartItems::-webkit-scrollbar-track {
        background: var(--color-off-white);
    }

    #cartItems::-webkit-scrollbar-thumb {
        background: var(--color-mid-gray);
        border-radius: var(--radius-full);
    }

    /* Mobile menu animations */
    #mobileMenu {
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Cart item hover */
    .cart-item:hover {
        background: var(--color-off-white);
        border-radius: var(--radius-sm);
    }

    /* Responsive */
    @media (max-width: 768px) {
        #cartSidebar {
            width: 100%;
            right: -100%;
        }
    }
</style>
