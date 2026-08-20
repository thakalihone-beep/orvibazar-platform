<!-- resources/views/pages/vendor-agreement.blade.php -->
@extends('layouts.app')

@section('title', 'Vendor Agreement - OrviBazar')

@section('content')
<div style="padding: var(--spacing-2xl) 0; background: var(--color-bg-light); min-height: 100vh;">
    <div class="container" style="max-width: var(--container-max); margin: 0 auto; padding: 0 var(--container-padding);">

        <!-- Header -->
        <div style="text-align: center; margin-bottom: var(--spacing-2xl);">
            <div style="display: inline-block; background: rgba(232, 168, 56, 0.1); padding: var(--spacing-lg); border-radius: 50%; margin-bottom: var(--spacing-md);">
                <i class="fas fa-handshake" style="font-size: 40px; color: var(--color-accent);"></i>
            </div>
            <h1 style="font-size: var(--font-size-3xl); font-weight: var(--font-weight-extrabold); color: var(--color-primary); margin-bottom: var(--spacing-sm);">
                Vendor Agreement
            </h1>
            <p style="color: var(--color-text-muted); font-size: var(--font-size-sm);">
                Last Updated: {{ date('F d, Y') }}
            </p>
        </div>

        <!-- Content -->
        <div style="max-width: 900px; margin: 0 auto; background: white; border-radius: var(--radius-2xl); padding: var(--spacing-2xl); box-shadow: var(--shadow-sm);">

            <!-- Introduction -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <div style="background: rgba(232, 168, 56, 0.05); padding: var(--spacing-md); border-radius: var(--radius-md); border-left: 4px solid var(--color-accent); margin-bottom: var(--spacing-md);">
                    <p style="color: var(--color-text-secondary); font-weight: var(--font-weight-medium);">
                        <i class="fas fa-info-circle" style="color: var(--color-accent);"></i>
                        This Vendor Agreement outlines the terms and conditions for selling products on the OrviBazar platform.
                    </p>
                </div>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                    By registering as a vendor on OrviBazar, you agree to comply with all terms and conditions outlined in this agreement.
                    Please read this document carefully before proceeding.
                </p>
            </div>

            <!-- Vendor Eligibility -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    1. Vendor Eligibility
                </h2>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You must be at least 18 years old and legally authorized to sell products.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You must provide accurate business information and valid identification.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You must comply with all applicable laws and regulations.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You must have the legal right to sell the products you list.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Product Listing Requirements -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    2. Product Listing Requirements
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    All products listed on the platform must meet the following requirements:
                </p>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Products must be genuine, authentic, and legally obtained.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Products must comply with all safety standards and regulations.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Product descriptions must be accurate and not misleading.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            High-quality images must be provided for each product.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-check-circle" style="color: var(--color-success); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Inventory levels must be kept up to date.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Pricing & Fees -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    3. Pricing & Fees
                </h2>
                <div style="background: var(--color-off-white); padding: var(--spacing-md); border-radius: var(--radius-md); margin-bottom: var(--spacing-md);">
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-md);">
                        <div>
                            <p style="font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 0;">Commission Rate</p>
                            <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin: 0;">10%</p>
                        </div>
                        <div>
                            <p style="font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 0;">Transaction Fee</p>
                            <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin: 0;">$0.50</p>
                        </div>
                        <div>
                            <p style="font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 0;">Listing Fee</p>
                            <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin: 0;">Free</p>
                        </div>
                        <div>
                            <p style="font-size: var(--font-size-sm); color: var(--color-text-muted); margin: 0;">Payout Period</p>
                            <p style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin: 0;">14 Days</p>
                        </div>
                    </div>
                </div>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-dollar-sign" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You set your own product prices, and we deduct a commission on each sale.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-dollar-sign" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Payouts are processed on a bi-weekly basis after order completion.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-dollar-sign" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You are responsible for any applicable taxes on your sales.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Order Fulfillment -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    4. Order Fulfillment
                </h2>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-clock" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Orders must be processed within 24-48 hours of confirmation.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-truck" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Shipping information must be provided promptly after dispatch.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-box" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Products must be packaged securely to prevent damage during transit.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-undo" style="color: var(--color-accent); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            You must accept returns and process refunds according to our Return Policy.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Quality Standards -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    5. Quality Standards
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    As a vendor, you are expected to maintain high quality standards:
                </p>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-star" style="color: var(--color-star); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Maintain a minimum rating of 4.0 stars.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-star" style="color: var(--color-star); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Respond to customer inquiries within 24 hours.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-star" style="color: var(--color-star); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Maintain a fulfillment rate of 95% or higher.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-star" style="color: var(--color-star); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Resolve customer issues promptly and professionally.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Vendor Termination -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    6. Vendor Termination
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-md);">
                    We reserve the right to terminate vendor accounts for:
                </p>
                <ul style="list-style: none; padding: 0;">
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-times-circle" style="color: var(--color-error); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Violation of this Vendor Agreement.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-times-circle" style="color: var(--color-error); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Selling counterfeit or prohibited items.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-times-circle" style="color: var(--color-error); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Poor performance or customer satisfaction ratings.
                        </span>
                    </li>
                    <li style="padding: var(--spacing-sm) 0; display: flex; gap: var(--spacing-sm); align-items: start;">
                        <i class="fas fa-times-circle" style="color: var(--color-error); margin-top: 4px;"></i>
                        <span style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                            Fraudulent or deceptive practices.
                        </span>
                    </li>
                </ul>
            </div>

            <!-- Dispute Resolution -->
            <div style="margin-bottom: var(--spacing-xl); padding-bottom: var(--spacing-xl); border-bottom: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    7. Dispute Resolution
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose);">
                    Any disputes arising between vendors and customers will be mediated by OrviBazar. We strive to
                    resolve disputes fairly and promptly. Both parties agree to cooperate in good faith to resolve any issues.
                </p>
            </div>

            <!-- Agreement Acceptance -->
            <div style="margin-top: var(--spacing-xl); padding-top: var(--spacing-xl); border-top: 1px solid var(--color-border-light);">
                <h2 style="font-size: var(--font-size-xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-md);">
                    Accepting the Agreement
                </h2>
                <p style="color: var(--color-text-secondary); line-height: var(--line-height-loose); margin-bottom: var(--spacing-lg);">
                    By clicking "I Accept" below, you acknowledge that you have read, understood, and agree to be bound by
                    this Vendor Agreement. You also confirm that you have the authority to enter into this agreement.
                </p>

                <div style="display: flex; gap: var(--spacing-md); flex-wrap: wrap; justify-content: center;">
                    <a href="/register/vendor" style="display: inline-flex; align-items: center; gap: var(--spacing-sm); padding: 14px 40px; background: var(--color-accent); color: var(--color-primary); border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-bold); transition: all var(--transition-fast);">
                        <i class="fas fa-check"></i> I Accept the Agreement
                    </a>
                    <a href="/register" style="display: inline-flex; align-items: center; gap: var(--spacing-sm); padding: 14px 40px; background: var(--color-off-white); color: var(--color-text-primary); border-radius: var(--radius-md); text-decoration: none; font-weight: var(--font-weight-medium); transition: all var(--transition-fast);">
                        <i class="fas fa-times"></i> Decline
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
