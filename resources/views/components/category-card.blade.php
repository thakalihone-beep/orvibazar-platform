{{-- <!-- resources/views/components/category-card.blade.php -->
@props([
    'icon' => 'fa-tag',
    'name' => 'Category',
    'count' => '0',
    'link' => '#'
])

<a href="{{ $link }}"
   style="display: block; background: white; padding: var(--spacing-lg); border-radius: var(--radius-lg); text-align: center; text-decoration: none; color: var(--color-text-primary); transition: all var(--transition-base); box-shadow: var(--shadow-sm);"
   class="category-card"
   onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='var(--shadow-hover)';"
   onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='var(--shadow-sm)';">

    <div style="width: 70px; height: 70px; margin: 0 auto var(--spacing-md); background: var(--color-off-white); border-radius: 50%; display: flex; align-items: center; justify-content: center; transition: all var(--transition-base);">
        <i class="fas {{ $icon }}" style="font-size: 28px; color: var(--color-primary);"></i>
    </div>

    <h3 style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); margin: 0 0 var(--spacing-xs) 0;">
        {{ $name }}
    </h3>

    <p style="color: var(--color-text-muted); font-size: var(--font-size-sm); margin: 0;">
        {{ $count }} products
    </p>
</a>

<style>
    .category-card:hover div:first-child {
        background: var(--color-accent) !important;
    }
    .category-card:hover div:first-child i {
        color: var(--color-primary) !important;
    }
</style> --}}
