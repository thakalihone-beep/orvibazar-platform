@extends('layouts.guest')

@section('title', 'Become a Vendor - OrviBazar')

@section('content')

<div
    style="
        max-width: 650px;
        width: 100%;
        margin: 30px auto;
        background: white;
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-lg);
        padding: var(--spacing-2xl);
        position: relative;
        overflow: hidden;
    "
>

    <!-- Top Decorative Line -->
    <div
        style="
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: linear-gradient(
                90deg,
                var(--color-primary),
                var(--color-accent)
            );
        "
    ></div>

    <!-- Back Button -->
    <a
        href="{{ route('option') }}"
        style="
            display: inline-flex;
            align-items: center;
            gap: var(--spacing-xs);
            color: var(--color-text-muted);
            text-decoration: none;
            font-size: var(--font-size-sm);
            margin-top: var(--spacing-sm);
            transition: color var(--transition-fast);
        "
        onmouseover="this.style.color='var(--color-primary)'"
        onmouseout="this.style.color='var(--color-text-muted)'"
    >
        <i class="fas fa-arrow-left"></i>
        Back
    </a>

    <!-- Header -->
    <div
        style="
            text-align: center;
            margin-top: var(--spacing-lg);
            margin-bottom: var(--spacing-xl);
        "
    >
        <div
            style="
                display: inline-flex;
                align-items: center;
                justify-content: center;
                background: var(--color-off-white);
                width: 70px;
                height: 70px;
                border-radius: 50%;
                margin-bottom: var(--spacing-md);
            "
        >
            <i
                class="fas fa-store"
                style="
                    font-size: 30px;
                    color: var(--color-primary);
                "
            ></i>
        </div>

        <h1
            style="
                font-size: var(--font-size-2xl);
                font-weight: var(--font-weight-bold);
                color: var(--color-primary);
                margin-bottom: var(--spacing-xs);
            "
        >
            Become a Vendor
        </h1>

        <p
            style="
                color: var(--color-text-muted);
                font-size: var(--font-size-sm);
            "
        >
            Join OrviBazar and start selling your products.
        </p>
    </div>

    <!-- Registration Form -->
    <form
        action="{{ route('vendor.store') }}"
        method="POST"
        enctype="multipart/form-data"
        style="
            display: flex;
            flex-direction: column;
            gap: var(--spacing-lg);
        "
    >
        @csrf

        <!-- ========================================= -->
        <!-- PERSONAL INFORMATION -->
        <!-- ========================================= -->

        <div>
            <h3
                style="
                    font-size: var(--font-size-md);
                    font-weight: var(--font-weight-semibold);
                    margin-bottom: var(--spacing-md);
                    color: var(--color-primary);
                "
            >
                <i
                    class="fas fa-user"
                    style="
                        color: var(--color-accent);
                        margin-right: var(--spacing-sm);
                    "
                ></i>
                Personal Information
            </h3>

            <!-- First + Last Name -->
            <div
                style="
                    display: grid;
                    grid-template-columns: 1fr 1fr;
                    gap: var(--spacing-md);
                "
            >
                <!-- First Name -->
                <div class="form-group">
                    <label
                        for="first_name"
                        style="
                            display: block;
                            font-weight: var(--font-weight-medium);
                            margin-bottom: var(--spacing-xs);
                            font-size: var(--font-size-sm);
                        "
                    >
                        First Name
                        <span style="color: var(--color-error);">*</span>
                    </label>

                    <input
                        type="text"
                        id="first_name"
                        name="first_name"
                        value="{{ old('first_name') }}"
                        required
                        placeholder="John"
                        style="
                            width: 100%;
                            padding: 10px 14px;
                            border: 1px solid var(--color-border-light);
                            border-radius: var(--radius-md);
                            font-size: var(--font-size-base);
                            transition: all var(--transition-fast);
                            outline: none;
                            background: white;
                        "
                        onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(26,26,26,0.1)'"
                        onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                    >

                    @error('first_name')
                        <small style="color: var(--color-error); display: block; margin-top: 4px; font-size: var(--font-size-xs);">
                            {{ $message }}
                        </small>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="form-group">
                    <label
                        for="last_name"
                        style="
                            display: block;
                            font-weight: var(--font-weight-medium);
                            margin-bottom: var(--spacing-xs);
                            font-size: var(--font-size-sm);
                        "
                    >
                        Last Name
                        <span style="color: var(--color-error);">*</span>
                    </label>

                    <input
                        type="text"
                        id="last_name"
                        name="last_name"
                        value="{{ old('last_name') }}"
                        required
                        placeholder="Doe"
                        style="
                            width: 100%;
                            padding: 10px 14px;
                            border: 1px solid var(--color-border-light);
                            border-radius: var(--radius-md);
                            font-size: var(--font-size-base);
                            transition: all var(--transition-fast);
                            outline: none;
                            background: white;
                        "
                        onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(26,26,26,0.1)'"
                        onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                    >

                    @error('last_name')
                        <small style="color: var(--color-error); display: block; margin-top: 4px; font-size: var(--font-size-xs);">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            </div>

            <!-- Email -->
            <div class="form-group" style="margin-top: var(--spacing-md);">
                <label
                    for="email"
                    style="
                        display: block;
                        font-weight: var(--font-weight-medium);
                        margin-bottom: var(--spacing-xs);
                        font-size: var(--font-size-sm);
                    "
                >
                    Email Address
                    <span style="color: var(--color-error);">*</span>
                </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="vendor@example.com"
                    style="
                        width: 100%;
                        padding: 10px 14px;
                        border: 1px solid var(--color-border-light);
                        border-radius: var(--radius-md);
                        font-size: var(--font-size-base);
                        transition: all var(--transition-fast);
                        outline: none;
                        background: white;
                    "
                    onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(26,26,26,0.1)'"
                    onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                >

                @error('email')
                    <small style="color: var(--color-error); display: block; margin-top: 4px; font-size: var(--font-size-xs);">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <!-- Contact -->
            <div class="form-group" style="margin-top: var(--spacing-md);">
                <label
                    for="contact"
                    style="
                        display: block;
                        font-weight: var(--font-weight-medium);
                        margin-bottom: var(--spacing-xs);
                        font-size: var(--font-size-sm);
                    "
                >
                    Contact Number
                    <span style="color: var(--color-error);">*</span>
                </label>

                <input
                    type="tel"
                    id="contact"
                    name="contact"
                    value="{{ old('contact') }}"
                    required
                    placeholder="+977 98XXXXXXXX"
                    style="
                        width: 100%;
                        padding: 10px 14px;
                        border: 1px solid var(--color-border-light);
                        border-radius: var(--radius-md);
                        font-size: var(--font-size-base);
                        transition: all var(--transition-fast);
                        outline: none;
                        background: white;
                    "
                    onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(26,26,26,0.1)'"
                    onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                >

                @error('contact')
                    <small style="color: var(--color-error); display: block; margin-top: 4px; font-size: var(--font-size-xs);">
                        {{ $message }}
                    </small>
                @enderror
            </div>
        </div>

        <!-- ========================================= -->
        <!-- BUSINESS INFORMATION -->
        <!-- ========================================= -->

        <div
            style="
                border-top: 1px solid var(--color-border-light);
                padding-top: var(--spacing-lg);
            "
        >
            <h3
                style="
                    font-size: var(--font-size-md);
                    font-weight: var(--font-weight-semibold);
                    margin-bottom: var(--spacing-md);
                    color: var(--color-primary);
                "
            >
                <i
                    class="fas fa-building"
                    style="
                        color: var(--color-accent);
                        margin-right: var(--spacing-sm);
                    "
                ></i>
                Business Information
            </h3>

            <!-- Shop Name -->
            <div class="form-group">
                <label
                    for="shop_name"
                    style="
                        display: block;
                        font-weight: var(--font-weight-medium);
                        margin-bottom: var(--spacing-xs);
                        font-size: var(--font-size-sm);
                    "
                >
                    Shop Name
                    <span style="color: var(--color-error);">*</span>
                </label>

                <input
                    type="text"
                    id="shop_name"
                    name="shop_name"
                    value="{{ old('shop_name') }}"
                    required
                    placeholder="Your Shop Name"
                    style="
                        width: 100%;
                        padding: 10px 14px;
                        border: 1px solid var(--color-border-light);
                        border-radius: var(--radius-md);
                        font-size: var(--font-size-base);
                        transition: all var(--transition-fast);
                        outline: none;
                        background: white;
                    "
                    onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(26,26,26,0.1)'"
                    onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                >

                @error('shop_name')
                    <small style="color: var(--color-error); display: block; margin-top: 4px; font-size: var(--font-size-xs);">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <!-- PAN -->
            <div class="form-group" style="margin-top: var(--spacing-md);">
                <label
                    for="pan_no"
                    style="
                        display: block;
                        font-weight: var(--font-weight-medium);
                        margin-bottom: var(--spacing-xs);
                        font-size: var(--font-size-sm);
                    "
                >
                    PAN Number
                    <span style="color: var(--color-error);">*</span>
                </label>

                <input
                    type="text"
                    id="pan_no"
                    name="pan_no"
                    value="{{ old('pan_no') }}"
                    required
                    placeholder="Enter PAN Number"
                    style="
                        width: 100%;
                        padding: 10px 14px;
                        border: 1px solid var(--color-border-light);
                        border-radius: var(--radius-md);
                        font-size: var(--font-size-base);
                        transition: all var(--transition-fast);
                        outline: none;
                        background: white;
                    "
                    onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(26,26,26,0.1)'"
                    onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                >

                @error('pan_no')
                    <small style="color: var(--color-error); display: block; margin-top: 4px; font-size: var(--font-size-xs);">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <!-- Description -->
            <div class="form-group" style="margin-top: var(--spacing-md);">
                <label
                    for="description"
                    style="
                        display: block;
                        font-weight: var(--font-weight-medium);
                        margin-bottom: var(--spacing-xs);
                        font-size: var(--font-size-sm);
                    "
                >
                    Shop Description
                    <span style="color: var(--color-text-muted); font-weight: var(--font-weight-regular);">
                        (Optional)
                    </span>
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    maxlength="1000"
                    placeholder="Tell us about your shop and the products you sell..."
                    style="
                        width: 100%;
                        padding: 10px 14px;
                        border: 1px solid var(--color-border-light);
                        border-radius: var(--radius-md);
                        font-size: var(--font-size-base);
                        transition: all var(--transition-fast);
                        outline: none;
                        resize: vertical;
                        font-family: inherit;
                        background: white;
                    "
                    onfocus="this.style.borderColor='var(--color-primary)'; this.style.boxShadow='0 0 0 3px rgba(26,26,26,0.1)'"
                    onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                >{{ old('description') }}</textarea>

                @error('description')
                    <small style="color: var(--color-error); display: block; margin-top: 4px; font-size: var(--font-size-xs);">
                        {{ $message }}
                    </small>
                @enderror
            </div>
        </div>

        <!-- ========================================= -->
        <!-- SHOP IMAGES -->
        <!-- ========================================= -->

        <div
            style="
                border-top: 1px solid var(--color-border-light);
                padding-top: var(--spacing-lg);
            "
        >
            <h3
                style="
                    font-size: var(--font-size-md);
                    font-weight: var(--font-weight-semibold);
                    margin-bottom: var(--spacing-md);
                    color: var(--color-primary);
                "
            >
                <i
                    class="fas fa-images"
                    style="
                        color: var(--color-accent);
                        margin-right: var(--spacing-sm);
                    "
                ></i>
                Shop Images
            </h3>

            <!-- Logo -->
            <div class="form-group">
                <label
                    for="logo"
                    style="
                        display: block;
                        font-weight: var(--font-weight-medium);
                        margin-bottom: var(--spacing-xs);
                        font-size: var(--font-size-sm);
                    "
                >
                    Shop Logo
                    <span style="color: var(--color-text-muted); font-weight: var(--font-weight-regular);">
                        (Optional)
                    </span>
                </label>

                <input
                    type="file"
                    id="logo"
                    name="logo"
                    accept=".jpg,.jpeg,.png,.webp"
                    style="
                        width: 100%;
                        padding: 10px;
                        border: 1px solid var(--color-border-light);
                        border-radius: var(--radius-md);
                        transition: all var(--transition-fast);
                        background: white;
                        cursor: pointer;
                    "
                    onfocus="this.style.borderColor='var(--color-primary)'"
                    onblur="this.style.borderColor='var(--color-border-light)'"
                >

                <small style="color: var(--color-text-muted); font-size: var(--font-size-xs); display: block; margin-top: 4px;">
                    JPG, PNG or WEBP. Maximum 2MB.
                </small>

                @error('logo')
                    <small style="color: var(--color-error); display: block; margin-top: 4px; font-size: var(--font-size-xs);">
                        {{ $message }}
                    </small>
                @enderror
            </div>

            <!-- Banner -->
            <div class="form-group" style="margin-top: var(--spacing-md);">
                <label
                    for="banner"
                    style="
                        display: block;
                        font-weight: var(--font-weight-medium);
                        margin-bottom: var(--spacing-xs);
                        font-size: var(--font-size-sm);
                    "
                >
                    Shop Banner
                    <span style="color: var(--color-text-muted); font-weight: var(--font-weight-regular);">
                        (Optional)
                    </span>
                </label>

                <input
                    type="file"
                    id="banner"
                    name="banner"
                    accept=".jpg,.jpeg,.png,.webp"
                    style="
                        width: 100%;
                        padding: 10px;
                        border: 1px solid var(--color-border-light);
                        border-radius: var(--radius-md);
                        transition: all var(--transition-fast);
                        background: white;
                        cursor: pointer;
                    "
                    onfocus="this.style.borderColor='var(--color-primary)'"
                    onblur="this.style.borderColor='var(--color-border-light)'"
                >

                <small style="color: var(--color-text-muted); font-size: var(--font-size-xs); display: block; margin-top: 4px;">
                    JPG, PNG or WEBP. Maximum 5MB.
                </small>

                @error('banner')
                    <small style="color: var(--color-error); display: block; margin-top: 4px; font-size: var(--font-size-xs);">
                        {{ $message }}
                    </small>
                @enderror
            </div>
        </div>

        <!-- ========================================= -->
        <!-- TERMS -->
        <!-- ========================================= -->

        <div
            style="
                display: flex;
                align-items: flex-start;
                gap: var(--spacing-sm);
                padding: var(--spacing-md);
                background: var(--color-off-white);
                border-radius: var(--radius-md);
            "
        >
            <input
                type="checkbox"
                id="terms"
                name="terms"
                value="1"
                required
                style="
                    width: 18px;
                    height: 18px;
                    margin-top: 2px;
                    accent-color: var(--color-primary);
                    cursor: pointer;
                    flex-shrink: 0;
                "
            >

            <label
                for="terms"
                style="
                    font-size: var(--font-size-sm);
                    color: var(--color-text-secondary);
                    cursor: pointer;
                    line-height: var(--line-height-normal);
                "
            >
                I agree to the
                <a
                    href="{{ route('terms.service') }}"
                    style="
                        color: var(--color-primary);
                        text-decoration: none;
                        font-weight: var(--font-weight-medium);
                        transition: color var(--transition-fast);
                    "
                    onmouseover="this.style.color='var(--color-accent)'"
                    onmouseout="this.style.color='var(--color-primary)'"
                >
                    Terms of Service
                </a>
                and
                <a
                    href="{{ route('vendor.agreement') }}"
                    style="
                        color: var(--color-primary);
                        text-decoration: none;
                        font-weight: var(--font-weight-medium);
                        transition: color var(--transition-fast);
                    "
                    onmouseover="this.style.color='var(--color-accent)'"
                    onmouseout="this.style.color='var(--color-primary)'"
                >
                    Vendor Agreement
                </a>.

                I confirm that all information provided is accurate.

                <span style="color: var(--color-error);">*</span>
            </label>
        </div>

        <!-- ========================================= -->
        <!-- SUBMIT -->
        <!-- ========================================= -->

        <button
            type="submit"
            style="
                padding: 14px 30px;
                background: var(--color-accent);
                color: var(--color-primary);
                border: none;
                border-radius: var(--radius-md);
                font-size: var(--font-size-lg);
                font-weight: var(--font-weight-bold);
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                gap: var(--spacing-sm);
                margin: var(--spacing-sm) auto 0;
                transition: all var(--transition-base);
                width: 100%;
            "
            onmouseover="this.style.transform='scale(1.02)'; this.style.boxShadow='var(--shadow-glow)'"
            onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='none'"
        >
            <i class="fas fa-store"></i>
            Submit Vendor Application
        </button>

        <!-- Login -->
        <p
            style="
                text-align: center;
                margin-top: var(--spacing-md);
                font-size: var(--font-size-sm);
                color: var(--color-text-muted);
            "
        >
            Already have an account?

            <a
                href="/login"
                style="
                    color: var(--color-primary);
                    text-decoration: none;
                    font-weight: var(--font-weight-medium);
                    transition: color var(--transition-fast);
                "
                onmouseover="this.style.color='var(--color-accent)'"
                onmouseout="this.style.color='var(--color-primary)'"
            >
                Login here
            </a>
        </p>

    </form>
</div>

<style>
    /* Custom styles using main.css variables */
    .form-group input:focus,
    .form-group textarea:focus,
    .form-group select:focus {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 3px rgba(26, 26, 26, 0.1) !important;
    }

    .form-group input.error,
    .form-group textarea.error,
    .form-group select.error {
        border-color: var(--color-error) !important;
    }

    /* File input styling */
    input[type="file"]:hover {
        border-color: var(--color-primary) !important;
        background: var(--color-off-white) !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .vendor-registration {
            padding: var(--spacing-lg) !important;
            margin: var(--spacing-md) !important;
        }

        .vendor-registration .grid-2 {
            grid-template-columns: 1fr !important;
        }
    }

    @media (max-width: 480px) {
        .vendor-registration {
            padding: var(--spacing-md) !important;
            margin: var(--spacing-sm) !important;
        }

        .vendor-registration .grid-2 {
            grid-template-columns: 1fr !important;
        }
    }
</style>

@endsection
