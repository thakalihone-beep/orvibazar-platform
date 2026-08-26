@extends('layouts.app')

@section('title', 'All Categories - OrviBazar')

@section('content')
<div style="padding: var(--spacing-2xl) 0; background: var(--color-bg-light); min-height: 60vh;">
    <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

        <!-- Page Header -->
        <div style="margin-bottom: var(--spacing-xl);">
            <h1 style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-bold); display: flex; align-items: center; gap: var(--spacing-sm);">
                <i class="fas fa-th-large" style="color: var(--color-accent);"></i>
                All Categories
            </h1>
            <p style="color: var(--color-text-muted); margin-top: var(--spacing-xs);">
                <i class="fas fa-info-circle"></i>
                Browse products by category. Find exactly what you're looking for.
            </p>
        </div>

        <!-- Categories Grid -->
        @if($categories && $categories->count() > 0)
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: var(--spacing-lg);">
            @foreach($categories as $category)
            <a href="{{ route('category.show', $category->slug) }}"
                style="text-decoration: none; color: var(--color-text-primary); display: block;"
                class="category-card">
                <div style="background: white; border-radius: var(--radius-lg); padding: var(--spacing-xl); text-align: center; box-shadow: var(--shadow-sm); transition: all var(--transition-base); height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;"
                    onmouseover="this.style.boxShadow='var(--shadow-lg)'; this.style.transform='translateY(-4px)'"
                    onmouseout="this.style.boxShadow='var(--shadow-sm)'; this.style.transform='translateY(0)'">

                    <!-- Category Icon -->
                    <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--color-off-white); display: flex; align-items: center; justify-content: center; margin-bottom: var(--spacing-md); font-size: 32px; color: var(--color-accent); transition: all var(--transition-base);"
                        onmouseover="this.style.background='var(--color-accent)'; this.style.color='white'"
                        onmouseout="this.style.background='var(--color-off-white)'; this.style.color='var(--color-accent)'">
                        <i class="fas {{ $category->icon ?? 'fa-tag' }}"></i>
                    </div>

                    <!-- Category Name -->
                    <h3 style="font-size: var(--font-size-lg); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-xs);">
                        {{ $category->name }}
                    </h3>

                    <!-- Product Count -->
                    <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">
                        {{ $category->products_count }} {{ Str::plural('product', $category->products_count) }}
                    </p>

                    <!-- Arrow Indicator -->
                    <div style="margin-top: var(--spacing-md); color: var(--color-accent); transition: all var(--transition-base);"
                        onmouseover="this.style.transform='translateX(4px)'"
                        onmouseout="this.style.transform='translateX(0)'">
                        <i class="fas fa-arrow-right"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <!-- Empty State -->
        <div style="text-align: center; padding: var(--spacing-3xl) 0; background: white; border-radius: var(--radius-lg); box-shadow: var(--shadow-sm);">
            <div style="font-size: 80px; color: var(--color-border-light); margin-bottom: var(--spacing-lg);">
                <i class="fas fa-folder-open"></i>
            </div>
            <h2 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); margin-bottom: var(--spacing-md); color: var(--color-text-primary);">
                No Categories Found
            </h2>
            <p style="color: var(--color-text-muted); max-width: 400px; margin: 0 auto var(--spacing-xl); line-height: var(--line-height-loose);">
                We're currently adding categories. Please check back later!
            </p>
            <a href="{{ route('home') }}"
                style="background: var(--color-accent); color: var(--color-primary); padding: 14px 40px; border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-bold); display: inline-flex; align-items: center; gap: var(--spacing-sm); transition: all var(--transition-fast);"
                onmouseover="this.style.transform='scale(1.05)'"
                onmouseout="this.style.transform='scale(1)'">
                <i class="fas fa-home"></i> Back to Home
            </a>
        </div>
        @endif
    </div>
</div>

<style>
    .category-card {
        transition: all 0.3s ease;
    }

    .category-card:hover {
        transform: translateY(-4px);
    }
</style>
@endsection
