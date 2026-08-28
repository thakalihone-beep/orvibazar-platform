<!-- resources/views/cart.blade.php -->
@extends('layouts.app') <!-- Uses app layout with navbar -->

@section('title', 'Shopping Cart - OrviBazar')

@section('content')
    <!-- Cart content here -->
    <div style="padding: var(--spacing-2xl) 0;">
        <div class="container">

            <div class="container"
                style="max-width: var(--container-max); margin: 0 auto; padding: var(--spacing-2xl) var(--container-padding);">
                <h1
                    style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-xl);">
                    <i class="fas fa-shopping-cart" style="color: var(--color-accent);"></i> Shopping Cart
                </h1>

                @php
                    $hasItems = true; // Set to false to show empty cart
                @endphp

                @if (!$hasItems)
                    <div style="text-align: center; padding: var(--spacing-3xl) 0;">
                        <i class="fas fa-shopping-basket"
                            style="font-size: 64px; color: var(--color-text-muted); margin-bottom: var(--spacing-lg); display: block;"></i>
                        <h2 style="font-size: var(--font-size-xl); margin-bottom: var(--spacing-md);">Your cart is empty
                        </h2>
                        <p style="color: var(--color-text-muted); margin-bottom: var(--spacing-lg);">Browse our products and
                            find something you love!</p>
                        <a href="#" class="btn-accent"
                            style="display: inline-block; padding: 12px 32px; text-decoration: none; border-radius: var(--radius-md); font-weight: var(--font-weight-bold);">
                            <i class="fas fa-shopping-bag"></i> Start Shopping
                        </a>
                    </div>
                @else
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: var(--spacing-2xl);">
                        <!-- Cart Items -->
                        <div>
                            @for ($i = 1; $i <= 3; $i++)
                                <div
                                    style="display: flex; gap: var(--spacing-md); padding: var(--spacing-md) 0; border-bottom: 1px solid var(--color-border-light); align-items: center;">
                                    <div
                                        style="width: 100px; height: 100px; flex-shrink: 0; border-radius: var(--radius-md); overflow: hidden; background: var(--color-off-white);">
                                        <img src="https://via.placeholder.com/100x100/{{ rand(1, 9) }}d{{ rand(1, 9) }}d{{ rand(1, 9) }}d/ffffff?text=Item+{{ $i }}"
                                            alt="Product" style="width: 100%; height: 100%; object-fit: cover;">
                                    </div>
                                    <div style="flex: 1;">
                                        <h3
                                            style="font-size: var(--font-size-md); font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs);">
                                            <a href="#"
                                                style="color: var(--color-text-primary); text-decoration: none;">
                                                Product {{ $i }} - Premium Quality Item
                                            </a>
                                        </h3>
                                        <p
                                            style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin-bottom: var(--spacing-xs);">
                                            SKU: PRD-00{{ $i }}
                                        </p>
                                        <div style="display: flex; align-items: center; gap: var(--spacing-md);">
                                            <div
                                                style="display: inline-flex; align-items: center; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); overflow: hidden;">
                                                <button
                                                    style="background: var(--color-bg-light); border: none; padding: 6px 12px; cursor: pointer; font-size: var(--font-size-lg); transition: background var(--transition-fast); min-width: 36px;">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" value="{{ $i + 1 }}" min="1"
                                                    max="99"
                                                    style="width: 50px; text-align: center; border: none; border-left: 1px solid var(--color-border-light); border-right: 1px solid var(--color-border-light); padding: 6px 0; font-size: var(--font-size-base); font-weight: var(--font-weight-medium); background: white;"
                                                    readonly>
                                                <button
                                                    style="background: var(--color-bg-light); border: none; padding: 6px 12px; cursor: pointer; font-size: var(--font-size-lg); transition: background var(--transition-fast); min-width: 36px;">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                            <span
                                                style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); color: var(--color-primary);">
                                                ${{ number_format(rand(20, 99) + 0.99, 2) }}
                                            </span>
                                        </div>
                                    </div>
                                    <button
                                        style="background: none; border: none; color: var(--color-text-muted); cursor: pointer; padding: var(--spacing-xs); transition: color var(--transition-fast); font-size: var(--font-size-lg);">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endfor
                        </div>

                        <!-- Order Summary -->
                        <div
                            style="background: var(--color-off-white); padding: var(--spacing-lg); border-radius: var(--radius-lg); position: sticky; top: 100px; height: fit-content;">
                            <h3
                                style="font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-lg);">
                                Order Summary</h3>

                            <div style="display: flex; justify-content: space-between; padding: var(--spacing-xs) 0;">
                                <span style="color: var(--color-text-muted);">Subtotal</span>
                                <span>$149.97</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: var(--spacing-xs) 0;">
                                <span style="color: var(--color-text-muted);">Shipping</span>
                                <span>$10.00</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; padding: var(--spacing-xs) 0;">
                                <span style="color: var(--color-text-muted);">Tax (8%)</span>
                                <span>$12.80</span>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); border-top: 2px solid var(--color-border-light); padding-top: var(--spacing-md); margin-top: var(--spacing-sm);">
                                <span>Total</span>
                                <span style="color: var(--color-primary);">$172.77</span>
                            </div>

                            <!-- Promo Code -->
                            <div style="margin: var(--spacing-lg) 0;">
                                <div style="display: flex; gap: var(--spacing-sm);">
                                    <input type="text" placeholder="Promo code"
                                        style="flex: 1; padding: 8px 12px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-sm);">
                                    <button
                                        style="padding: 8px 16px; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-md); font-weight: var(--font-weight-medium); cursor: pointer; white-space: nowrap;">
                                        Apply
                                    </button>
                                </div>
                            </div>

                            <a href="#" class="btn-accent"
                                style="display: block; text-align: center; padding: 14px; text-decoration: none; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); width: 100%;">
                                <i class="fas fa-lock"></i> Proceed to Checkout
                            </a>

                            <a href="#"
                                style="display: block; text-align: center; margin-top: var(--spacing-md); color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm);">
                                <i class="fas fa-arrow-left"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
