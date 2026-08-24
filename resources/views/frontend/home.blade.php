<!-- resources/views/home.blade.php -->
@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section style="background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%); padding: var(--spacing-4xl) 0; color: var(--color-text-light); margin-bottom: var(--spacing-2xl);">
        <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-2xl); align-items: center;">
                <div>
                    <h1 style="font-size: var(--font-size-4xl); font-weight: var(--font-weight-extrabold); line-height: var(--line-height-tight); margin-bottom: var(--spacing-lg);">
                        Discover Amazing <br>
                        <span style="color: var(--color-accent);">Products</span> at Great Prices
                    </h1>
                    <p style="font-size: var(--font-size-lg); color: var(--color-text-muted); margin-bottom: var(--spacing-xl); line-height: var(--line-height-loose);">
                        Shop the latest trends, premium quality products, and exclusive deals.
                        Your satisfaction is our priority.
                    </p>
                    <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap;">
                        <a href="{{ route('shop') }}" class="btn-accent" style="padding: 14px 36px; text-decoration: none; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); display: inline-flex; align-items: center; gap: var(--spacing-sm);">
                            <i class="fas fa-shopping-bag"></i> Shop Now
                        </a>
                        <a href="{{ route('categories') }}" class="btn-outline" style="padding: 14px 36px; text-decoration: none; border-radius: var(--radius-md); font-weight: var(--font-weight-semibold); color: white; border-color: rgba(255,255,255,0.3); display: inline-flex; align-items: center; gap: var(--spacing-sm);">
                            <i class="fas fa-bars"></i> Browse Categories
                        </a>
                    </div>
                    <div style="display: flex; gap: var(--spacing-xl); margin-top: var(--spacing-xl);">
                        <div>
                            <span style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-accent);">{{ number_format($totalCustomers ?? 10000) }}+</span>
                            <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">Happy Customers</p>
                        </div>
                        <div>
                            <span style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-accent);">{{ number_format($totalProducts ?? 500) }}+</span>
                            <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">Products</p>
                        </div>
                        <div>
                            <span style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-accent);">{{ number_format($averageRating ?? 4.8, 1) }}★</span>
                            <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">Average Rating</p>
                        </div>
                    </div>
                </div>
                <div style="position: relative; display: flex; justify-content: center; align-items: center;">
                    <div style="background: var(--color-accent); width: 400px; height: 400px; border-radius: 50%; opacity: 0.1; position: absolute;"></div>
                    <div style="background: var(--color-primary-light); padding: var(--spacing-2xl); border-radius: var(--radius-2xl); box-shadow: var(--shadow-xl); text-align: center; position: relative; z-index: 1; max-width: 350px;">
                        <i class="fas fa-tag" style="font-size: 60px; color: var(--color-accent);"></i>
                        <h2 style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-bold); margin: var(--spacing-md) 0;">
                            Up to <span style="color: var(--color-accent);">{{ $maxDiscount ?? 50 }}%</span> Off
                        </h2>
                        <p style="color: var(--color-text-muted);">Summer Sale Collection</p>
                        <a href="{{ route('sale') }}" style="display: inline-block; margin-top: var(--spacing-md); color: var(--color-accent); font-weight: var(--font-weight-semibold); text-decoration: none;">
                            Shop Sale <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section style="padding: var(--spacing-2xl) 0;">
        <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-xl);">
                <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold);">
                    <i class="fas fa-th-large" style="color: var(--color-accent);"></i> Shop by Category
                </h2>
                <a href="{{ route('categories') }}" style="color: var(--color-primary); font-weight: var(--font-weight-medium); text-decoration: none; display: inline-flex; align-items: center; gap: var(--spacing-xs);">
                    View All <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: var(--spacing-lg);">
                @forelse($categories ?? [] as $category)
                    <x-category_card
                        icon="{{ $category->icon ?? 'fa-tag' }}"
                        name="{{ $category->name }}"
                        count="{{ number_format($category->products_count ?? 0) }}"
                        link="{{ route('category.show', $category->slug) }}"
                    />
                @empty
                    <x-category_card icon="fa-laptop" name="Electronics" count="1,234" />
                    <x-category_card icon="fa-tshirt" name="Fashion" count="856" />
                    <x-category_card icon="fa-home" name="Home & Living" count="542" />
                    <x-category_card icon="fa-spa" name="Beauty" count="321" />
                    <x-category_card icon="fa-dumbbell" name="Sports" count="234" />
                    <x-category_card icon="fa-book" name="Books" count="789" />
                @endforelse
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section style="padding: var(--spacing-2xl) 0; background: var(--color-bg-light);">
        <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-xl);">
                <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold);">
                    <i class="fas fa-star" style="color: var(--color-accent);"></i> Featured Products
                </h2>
                <a href="{{ route('shop') }}" style="color: var(--color-primary); font-weight: var(--font-weight-medium); text-decoration: none; display: inline-flex; align-items: center; gap: var(--spacing-xs);">
                    View All <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: var(--spacing-lg);">
                @forelse($featuredProducts ?? [] as $product)
                    <x-product-card
                        :product="$product"
                        image="{{ $product->image_url }}"
                        title="{{ $product->name }}"
                        price="{{ $product->price }}"
                        discount_price="{{ $product->discount_price }}"
                        rating="{{ $product->average_rating ?? 0 }}"
                        reviews="{{ $product->reviews_count ?? 0 }}"
                        stock="{{ $product->stock_status }}"
                        sale="{{ $product->is_on_sale }}"
                        link="{{ route('product.show', $product->slug) }}"
                        product_id="{{ $product->id }}"
                    />
                @empty
                    <x-product_card
                        image="https://via.placeholder.com/300x300/1a1a1a/ffffff?text=Headphones"
                        title="Wireless Bluetooth Headphones"
                        price="129.99"
                        discount_price="79.99"
                        rating="4.5"
                        reviews="234"
                        stock="in-stock"
                        sale="true"
                    />
                    <x-product_card
                        image="https://via.placeholder.com/300x300/2d2d2d/ffffff?text=Watch"
                        title="Smart Fitness Tracker Watch"
                        price="49.99"
                        discount_price=""
                        rating="4.8"
                        reviews="189"
                        stock="in-stock"
                        sale="false"
                    />
                    <x-product_card
                        image="https://via.placeholder.com/300x300/3d3d3d/ffffff?text=T-Shirt"
                        title="Organic Cotton T-Shirt (Pack of 3)"
                        price="39.99"
                        discount_price="29.99"
                        rating="4.3"
                        reviews="156"
                        stock="low-stock"
                        sale="true"
                    />
                    <x-product_card
                        image="https://via.placeholder.com/300x300/4d4d4d/ffffff?text=Lamp"
                        title="Modern LED Desk Lamp"
                        price="34.99"
                        discount_price=""
                        rating="4.7"
                        reviews="98"
                        stock="in-stock"
                        sale="false"
                    />
                    <x-product_card
                        image="https://via.placeholder.com/300x300/5d5d5d/ffffff?text=Bag"
                        title="Leather Crossbody Bag"
                        price="89.99"
                        discount_price="59.99"
                        rating="4.6"
                        reviews="312"
                        stock="out-of-stock"
                        sale="true"
                    />
                    <x-product_card
                        image="https://via.placeholder.com/300x300/6d6d6d/ffffff?text=Shoes"
                        title="Running Shoes - Men's"
                        price="89.99"
                        discount_price=""
                        rating="4.9"
                        reviews="423"
                        stock="in-stock"
                        sale="false"
                    />
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sale Banner -->
    <section style="padding: var(--spacing-3xl) 0; background: linear-gradient(135deg, var(--color-accent) 0%, #f0c04a 100%);">
        <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding); text-align: center;">
            <h2 style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-extrabold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                <i class="fas fa-fire" style="margin-right: var(--spacing-sm);"></i> Flash Sale
            </h2>
            <p style="font-size: var(--font-size-lg); color: var(--color-primary); opacity: 0.8; margin-bottom: var(--spacing-xl);">
                Limited time offers on selected items. Don't miss out!
            </p>
            <div style="display: flex; justify-content: center; gap: var(--spacing-xl); flex-wrap: wrap; margin-bottom: var(--spacing-xl);">
                <div style="background: var(--color-primary); padding: var(--spacing-md) var(--spacing-xl); border-radius: var(--radius-md); min-width: 80px; color: white;">
                    <span style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); display: block;" id="hours">24</span>
                    <span style="font-size: var(--font-size-xs);">Hours</span>
                </div>
                <div style="background: var(--color-primary); padding: var(--spacing-md) var(--spacing-xl); border-radius: var(--radius-md); min-width: 80px; color: white;">
                    <span style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); display: block;" id="minutes">45</span>
                    <span style="font-size: var(--font-size-xs);">Minutes</span>
                </div>
                <div style="background: var(--color-primary); padding: var(--spacing-md) var(--spacing-xl); border-radius: var(--radius-md); min-width: 80px; color: white;">
                    <span style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); display: block;" id="seconds">30</span>
                    <span style="font-size: var(--font-size-xs);">Seconds</span>
                </div>
            </div>
            <a href="{{ route('sale') }}" class="btn-primary" style="background: var(--color-primary); color: white; padding: 14px 40px; text-decoration: none; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); display: inline-flex; align-items: center; gap: var(--spacing-sm);">
                <i class="fas fa-bolt"></i> Grab Deals Now
            </a>
        </div>
    </section>

    <!-- Testimonials -->
    <section style="padding: var(--spacing-3xl) 0;">
        <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">
            <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); text-align: center; margin-bottom: var(--spacing-xl);">
                <i class="fas fa-quote-left" style="color: var(--color-accent);"></i> What Our Customers Say
            </h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: var(--spacing-lg);">
                @forelse($testimonials ?? [] as $testimonial)
                    <div class="card" style="background: white; padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                        <div class="stars" style="display: flex; gap: 2px; margin-bottom: var(--spacing-sm);">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="star {{ $i <= $testimonial->rating ? 'filled' : '' }}" style="color: {{ $i <= $testimonial->rating ? 'var(--color-star)' : 'var(--color-star-empty)' }};">★</span>
                            @endfor                        </div>
                        <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">"{{ $testimonial->comment }}"</p>
                        <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-top: var(--spacing-md);">
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--color-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                {{ strtoupper(substr($testimonial->name, 0, 2)) }}
                            </div>
                            <div>
                                <p style="font-weight: var(--font-weight-semibold); margin: 0;">{{ $testimonial->name }}</p>
                                <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">Verified Buyer</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Static testimonials -->
                    <div class="card" style="background: white; padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                        <div class="stars" style="display: flex; gap: 2px; margin-bottom: var(--spacing-sm);">
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                        </div>
                        <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">"Amazing products! The quality is outstanding and delivery was super fast. Highly recommend OrviBazar!"</p>
                        <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-top: var(--spacing-md);">
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--color-primary); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">JD</div>
                            <div>
                                <p style="font-weight: var(--font-weight-semibold); margin: 0;">John Doe</p>
                                <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">Verified Buyer</p>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="background: white; padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                        <div class="stars" style="display: flex; gap: 2px; margin-bottom: var(--spacing-sm);">
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star" style="color: var(--color-star-empty);">★</span>
                        </div>
                        <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">"Great customer service! They helped me with my return and made the process so easy. Will shop again!"</p>
                        <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-top: var(--spacing-md);">
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--color-accent); display: flex; align-items: center; justify-content: center; color: var(--color-primary); font-weight: bold;">SM</div>
                            <div>
                                <p style="font-weight: var(--font-weight-semibold); margin: 0;">Sarah Miller</p>
                                <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">Verified Buyer</p>
                            </div>
                        </div>
                    </div>
                    <div class="card" style="background: white; padding: var(--spacing-lg); border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
                        <div class="stars" style="display: flex; gap: 2px; margin-bottom: var(--spacing-sm);">
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                            <span class="star filled" style="color: var(--color-star);">★</span>
                        </div>
                        <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">"The prices are unbeatable! I've been shopping here for months and always find great deals."</p>
                        <div style="display: flex; align-items: center; gap: var(--spacing-sm); margin-top: var(--spacing-md);">
                            <div style="width: 50px; height: 50px; border-radius: 50%; background: var(--color-primary-light); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">MR</div>
                            <div>
                                <p style="font-weight: var(--font-weight-semibold); margin: 0;">Mike Roberts</p>
                                <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">Verified Buyer</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Brands -->
    <section style="padding: var(--spacing-2xl) 0; background: var(--color-bg-light);">
        <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">
            <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-semibold); text-align: center; margin-bottom: var(--spacing-xl); color: var(--color-text-muted);">
                Trusted by Leading Brands
            </h2>
            <div style="display: flex; justify-content: center; align-items: center; gap: var(--spacing-2xl); flex-wrap: wrap; opacity: 0.6;">
                @forelse($brands ?? [] as $brand)
                    <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-text-muted);">{{ $brand->name }}</div>
                @empty
                    <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-text-muted);">NIKE</div>
                    <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-text-muted);">ADIDAS</div>
                    <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-text-muted);">SAMSUNG</div>
                    <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-text-muted);">APPLE</div>
                    <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-text-muted);">SONY</div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
// Flash Sale Countdown Timer
function startCountdown() {
    // Set the target time (24 hours from now)
    const targetTime = new Date();
    targetTime.setHours(targetTime.getHours() + 24);

    function updateTimer() {
        const now = new Date();
        const difference = targetTime - now;

        if (difference <= 0) {
            // Reset timer
            const newTarget = new Date();
            newTarget.setHours(newTarget.getHours() + 24);
            targetTime.setTime(newTarget.getTime());
            return;
        }

        const hours = Math.floor(difference / (1000 * 60 * 60));
        const minutes = Math.floor((difference % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((difference % (1000 * 60)) / 1000);

        document.getElementById('hours').textContent = String(hours).padStart(2, '0');
        document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
        document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
    }

    updateTimer();
    setInterval(updateTimer, 1000);
}

// Start countdown when page loads
document.addEventListener('DOMContentLoaded', startCountdown);
</script>
@endpush
