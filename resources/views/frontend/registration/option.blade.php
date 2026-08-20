<!-- resources/views/auth/register-option.blade.php -->
@extends('layouts.guest')

@section('title', 'Choose Registration Type - OrviBazar')

@section('content')
<div style="max-width: 800px; width: 100%; margin: 0 auto; padding: var(--spacing-xl); position: relative;">

    <!-- Go Back Button -->
    <a href="/" style="position: absolute; top: 0; left: 0; display: inline-flex; align-items: center; gap: var(--spacing-xs); color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: color var(--transition-fast); padding: var(--spacing-sm) var(--spacing-md); border-radius: var(--radius-md); background: var(--color-off-white);">
        <i class="fas fa-arrow-left"></i> Back to Home
    </a>

    <!-- Header -->
    <div style="text-align: center; margin-bottom: var(--spacing-2xl); margin-top: var(--spacing-xl);">
        <div style="display: inline-block; background: var(--color-off-white); padding: var(--spacing-lg); border-radius: 50%; margin-bottom: var(--spacing-md);">
            <i class="fas fa-user-plus" style="font-size: 40px; color: var(--color-primary);"></i>
        </div>
        <h1 style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-extrabold); color: var(--color-primary); margin-bottom: var(--spacing-sm);">
            Join OrviBazar
        </h1>
        <p style="color: var(--color-text-muted); font-size: var(--font-size-lg); max-width: 500px; margin: 0 auto;">
            Choose how you want to be part of our marketplace
        </p>
    </div>

    <!-- Registration Options Grid -->
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-2xl);">

        <!-- Customer Registration -->
        <div style="background: white; border-radius: var(--radius-2xl); padding: var(--spacing-2xl); box-shadow: var(--shadow-md); transition: all var(--transition-base); border: 2px solid transparent; text-align: center;"
             onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='var(--shadow-xl)'; this.style.borderColor='var(--color-primary)'"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)'; this.style.borderColor='transparent'">

            <!-- Icon -->
            <div style="width: 80px; height: 80px; margin: 0 auto var(--spacing-lg); background: var(--color-off-white); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-user" style="font-size: 36px; color: var(--color-primary);"></i>
            </div>

            <!-- Title -->
            <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-sm);">
                Customer Account
            </h2>

            <!-- Description -->
            <p style="color: var(--color-text-muted); line-height: var(--line-height-loose); margin-bottom: var(--spacing-lg);">
                Shop and buy products from various vendors. Enjoy exclusive deals, wishlist, and personalized recommendations.
            </p>

            <!-- Features -->
            <div style="text-align: left; margin-bottom: var(--spacing-lg);">
                <div style="display: flex; align-items: center; gap: var(--spacing-sm); padding: var(--spacing-xs) 0;">
                    <i class="fas fa-check-circle" style="color: var(--color-success);"></i>
                    <span style="font-size: var(--font-size-sm); color: var(--color-text-secondary);">Browse and purchase products</span>
                </div>
                <div style="display: flex; align-items: center; gap: var(--spacing-sm); padding: var(--spacing-xs) 0;">
                    <i class="fas fa-check-circle" style="color: var(--color-success);"></i>
                    <span style="font-size: var(--font-size-sm); color: var(--color-text-secondary);">Create wishlist</span>
                </div>
                <div style="display: flex; align-items: center; gap: var(--spacing-sm); padding: var(--spacing-xs) 0;">
                    <i class="fas fa-check-circle" style="color: var(--color-success);"></i>
                    <span style="font-size: var(--font-size-sm); color: var(--color-text-secondary);">Track orders</span>
                </div>
                <div style="display: flex; align-items: center; gap: var(--spacing-sm); padding: var(--spacing-xs) 0;">
                    <i class="fas fa-check-circle" style="color: var(--color-success);"></i>
                    <span style="font-size: var(--font-size-sm); color: var(--color-text-secondary);">Exclusive deals & discounts</span>
                </div>
            </div>

            <!-- Button -->
            <a href="{{ route('customer') }}" style="display: block; padding: 14px; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-md); font-weight: var(--font-weight-semibold); text-decoration: none; transition: all var(--transition-fast); text-align: center;">
                <i class="fas fa-user-plus"></i> Register as Customer
            </a>
        </div>

        <!-- Vendor Registration -->
        <div style="background: white; border-radius: var(--radius-2xl); padding: var(--spacing-2xl); box-shadow: var(--shadow-md); transition: all var(--transition-base); border: 2px solid transparent; text-align: center; position: relative; overflow: hidden;"
             onmouseover="this.style.transform='translateY(-8px)'; this.style.boxShadow='var(--shadow-xl)'; this.style.borderColor='var(--color-accent)'"
             onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-md)'; this.style.borderColor='transparent'">

            <!-- Popular Badge -->
            <div style="position: absolute; top: 20px; right: -30px; background: var(--color-accent); color: var(--color-primary); padding: 4px 40px; transform: rotate(45deg); font-size: var(--font-size-xs); font-weight: var(--font-weight-bold); text-transform: uppercase;">
                Popular
            </div>

            <!-- Icon -->
            <div style="width: 80px; height: 80px; margin: 0 auto var(--spacing-lg); background: rgba(232, 168, 56, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-store" style="font-size: 36px; color: var(--color-accent);"></i>
            </div>

            <!-- Title -->
            <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-accent); margin-bottom: var(--spacing-sm);">
                Vendor Account
            </h2>

            <!-- Description -->
            <p style="color: var(--color-text-muted); line-height: var(--line-height-loose); margin-bottom: var(--spacing-lg);">
                Sell your products to thousands of customers. Manage your store, inventory, and grow your business.
            </p>

            <!-- Features -->
            <div style="text-align: left; margin-bottom: var(--spacing-lg);">
                <div style="display: flex; align-items: center; gap: var(--spacing-sm); padding: var(--spacing-xs) 0;">
                    <i class="fas fa-check-circle" style="color: var(--color-success);"></i>
                    <span style="font-size: var(--font-size-sm); color: var(--color-text-secondary);">Create your own store</span>
                </div>
                <div style="display: flex; align-items: center; gap: var(--spacing-sm); padding: var(--spacing-xs) 0;">
                    <i class="fas fa-check-circle" style="color: var(--color-success);"></i>
                    <span style="font-size: var(--font-size-sm); color: var(--color-text-secondary);">Manage products & inventory</span>
                </div>
                <div style="display: flex; align-items: center; gap: var(--spacing-sm); padding: var(--spacing-xs) 0;">
                    <i class="fas fa-check-circle" style="color: var(--color-success);"></i>
                    <span style="font-size: var(--font-size-sm); color: var(--color-text-secondary);">Track sales & earnings</span>
                </div>
                <div style="display: flex; align-items: center; gap: var(--spacing-sm); padding: var(--spacing-xs) 0;">
                    <i class="fas fa-check-circle" style="color: var(--color-success);"></i>
                    <span style="font-size: var(--font-size-sm); color: var(--color-text-secondary);">Reach thousands of customers</span>
                </div>
            </div>

            <!-- Button -->
            <a href="{{ route('vendor') }}" style="display: block; padding: 14px; background: var(--color-accent); color: var(--color-primary); border: none; border-radius: var(--radius-md); font-weight: var(--font-weight-bold); text-decoration: none; transition: all var(--transition-fast); text-align: center;">
                <i class="fas fa-store"></i> Register as Vendor
            </a>
        </div>
    </div>

    <!-- Login Link -->
    <div style="text-align: center; margin-top: var(--spacing-2xl); padding-top: var(--spacing-xl); border-top: 1px solid var(--color-border-light);">
        <p style="color: var(--color-text-muted); font-size: var(--font-size-sm);">
            Already have an account? <a href="/login" style="color: var(--color-primary); text-decoration: none; font-weight: var(--font-weight-medium);">Login here</a>
        </p>
        <p style="color: var(--color-text-muted); font-size: var(--font-size-xs); margin-top: var(--spacing-sm);">
            By registering, you agree to our <a href="{{ route('terms.service') }}" style="color: var(--color-primary); text-decoration: none;">Terms of Service</a> and <a href="{{ route('privacy.policy') }}" style="color: var(--color-primary); text-decoration: none;">Privacy Policy</a>
        </p>
    </div>

    <!-- Statistics -->
    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--spacing-lg); margin-top: var(--spacing-2xl); padding: var(--spacing-lg); background: var(--color-off-white); border-radius: var(--radius-lg);">
        <div style="text-align: center;">
            <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-primary);">10K+</div>
            <div style="font-size: var(--font-size-xs); color: var(--color-text-muted);">Happy Customers</div>
        </div>
        <div style="text-align: center; border-left: 1px solid var(--color-border-light); border-right: 1px solid var(--color-border-light);">
            <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-primary);">500+</div>
            <div style="font-size: var(--font-size-xs); color: var(--color-text-muted);">Active Vendors</div>
        </div>
        <div style="text-align: center;">
            <div style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-primary);">4.8★</div>
            <div style="font-size: var(--font-size-xs); color: var(--color-text-muted);">Average Rating</div>
        </div>
    </div>
</div>
@endsection
