<!-- resources/views/auth/customer-register.blade.php -->
@extends('layouts.guest')

@section('title', 'Customer Registration - OrviBazar')

@section('content')
<div style="max-width: 520px; width: 100%; margin: 0 auto; background: white; border-radius: var(--radius-2xl); box-shadow: var(--shadow-lg); padding: var(--spacing-2xl); position: relative; overflow: hidden;">

    <!-- Decorative Header -->
    <div style="position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-accent) 100%);"></div>

    <!-- Back Button -->
    <a href="{{route('option')}}" style="display: inline-flex; align-items: center; gap: var(--spacing-xs); color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); margin-bottom: var(--spacing-md); transition: color var(--transition-fast);">
        <i class="fas fa-arrow-left"></i> Back
    </a>

    <!-- Header -->
    <div style="text-align: center; margin-bottom: var(--spacing-xl);">
        <div style="display: inline-block; background: var(--color-off-white); padding: var(--spacing-md); border-radius: 50%; margin-bottom: var(--spacing-md);">
            <i class="fas fa-user" style="font-size: 28px; color: var(--color-primary);"></i>
        </div>
        <h1 style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-xs);">
            Create Customer Account
        </h1>
        <p style="color: var(--color-text-muted); font-size: var(--font-size-sm);">
            Join our community of happy shoppers
        </p>
    </div>

    <!-- Registration Form -->
    <form id="customerRegistrationForm" onsubmit="return handleCustomerRegistration(event)" style="display: flex; flex-direction: column; gap: var(--spacing-lg);">

        <!-- Full Name -->
        <div class="form-group">
            <label for="fullName" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                Full Name <span style="color: var(--color-error);">*</span>
            </label>
            <input type="text" id="fullName" name="full_name" required
                   style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                   placeholder="John Doe">
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                Email Address <span style="color: var(--color-error);">*</span>
            </label>
            <input type="email" id="email" name="email" required
                   style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                   placeholder="you@example.com">
        </div>

        <!-- Phone -->
        <div class="form-group">
            <label for="phone" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                Phone Number <span style="color: var(--color-error);">*</span>
            </label>
            <input type="tel" id="phone" name="phone" required
                   style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                   placeholder="+1 234 567 8900">
        </div>

        <!-- Password -->
        <div class="form-group">
            <label for="password" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                Password <span style="color: var(--color-error);">*</span>
            </label>
            <div style="position: relative;">
                <input type="password" id="password" name="password" required minlength="8"
                       style="width: 100%; padding: 12px 16px; padding-right: 48px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                       placeholder="Minimum 8 characters">
                <button type="button" onclick="togglePassword('password')"
                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--color-text-muted); font-size: 18px;">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
            <div style="margin-top: var(--spacing-xs); font-size: var(--font-size-xs); color: var(--color-text-muted); display: flex; gap: var(--spacing-sm); flex-wrap: wrap;">
                <span id="lengthCheck" style="display: flex; align-items: center; gap: 4px;">
                    <i class="fas fa-circle" style="font-size: 6px; color: var(--color-text-muted);"></i> 8+ characters
                </span>
                <span id="upperCheck" style="display: flex; align-items: center; gap: 4px;">
                    <i class="fas fa-circle" style="font-size: 6px; color: var(--color-text-muted);"></i> Uppercase
                </span>
                <span id="numberCheck" style="display: flex; align-items: center; gap: 4px;">
                    <i class="fas fa-circle" style="font-size: 6px; color: var(--color-text-muted);"></i> Number
                </span>
            </div>
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <label for="password_confirmation" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                Confirm Password <span style="color: var(--color-error);">*</span>
            </label>
            <div style="position: relative;">
                <input type="password" id="password_confirmation" name="password_confirmation" required
                       style="width: 100%; padding: 12px 16px; padding-right: 48px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                       placeholder="Confirm your password">
                <button type="button" onclick="togglePassword('password_confirmation')"
                        style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--color-text-muted); font-size: 18px;">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>

        <!-- Terms & Conditions -->
        <div style="display: flex; align-items: start; gap: var(--spacing-sm); padding: var(--spacing-md); background: var(--color-off-white); border-radius: var(--radius-md);">
            <input type="checkbox" id="terms" name="terms" required
                   style="width: 18px; height: 18px; margin-top: 2px; accent-color: var(--color-primary); cursor: pointer;">
            <label for="terms" style="font-size: var(--font-size-sm); color: var(--color-text-secondary); cursor: pointer;">
                I agree to the <a href="{{route('terms.service')}}" style="color: var(--color-primary); text-decoration: none;">Terms of Service</a> and
                <a href="{{route('privacy.policy')}}" style="color: var(--color-primary); text-decoration: none;">Privacy Policy</a>.
                <span style="color: var(--color-error);">*</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" id="submitBtn"
                style="padding: 14px; background: var(--color-primary); color: white; border: none; border-radius: var(--radius-md); font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-base); display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm);">
            <i class="fas fa-user-plus"></i> Create Account
        </button>

        <!-- Login Link -->
        <p style="text-align: center; margin-top: var(--spacing-md); font-size: var(--font-size-sm); color: var(--color-text-muted);">
            Already have an account? <a href="/login" style="color: var(--color-primary); text-decoration: none; font-weight: var(--font-weight-medium);">Login here</a>
        </p>
    </form>
</div>

<script>
// ============================================
// PASSWORD STRENGTH CHECKER
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const password = document.getElementById('password');
    const lengthCheck = document.getElementById('lengthCheck');
    const upperCheck = document.getElementById('upperCheck');
    const numberCheck = document.getElementById('numberCheck');

    password.addEventListener('input', function() {
        const val = this.value;

        // Length check
        if (val.length >= 8) {
            lengthCheck.innerHTML = '<i class="fas fa-check-circle" style="color: var(--color-success);"></i> 8+ characters';
            lengthCheck.style.color = 'var(--color-success)';
        } else {
            lengthCheck.innerHTML = '<i class="fas fa-circle" style="font-size: 6px; color: var(--color-text-muted);"></i> 8+ characters';
            lengthCheck.style.color = 'var(--color-text-muted)';
        }

        // Uppercase check
        if (/[A-Z]/.test(val)) {
            upperCheck.innerHTML = '<i class="fas fa-check-circle" style="color: var(--color-success);"></i> Uppercase';
            upperCheck.style.color = 'var(--color-success)';
        } else {
            upperCheck.innerHTML = '<i class="fas fa-circle" style="font-size: 6px; color: var(--color-text-muted);"></i> Uppercase';
            upperCheck.style.color = 'var(--color-text-muted)';
        }

        // Number check
        if (/[0-9]/.test(val)) {
            numberCheck.innerHTML = '<i class="fas fa-check-circle" style="color: var(--color-success);"></i> Number';
            numberCheck.style.color = 'var(--color-success)';
        } else {
            numberCheck.innerHTML = '<i class="fas fa-circle" style="font-size: 6px; color: var(--color-text-muted);"></i> Number';
            numberCheck.style.color = 'var(--color-text-muted)';
        }
    });
});

// ============================================
// PASSWORD TOGGLE
// ============================================
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const button = input.nextElementSibling;
    const icon = button.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

// ============================================
// FORM HANDLING
// ============================================
function handleCustomerRegistration(event) {
    event.preventDefault();

    const form = document.getElementById('customerRegistrationForm');
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;

    // Validate passwords match
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('password_confirmation').value;

    if (password !== confirmPassword) {
        showToast('error', 'Passwords do not match!');
        document.getElementById('password_confirmation').style.borderColor = 'var(--color-error)';
        return false;
    }

    if (password.length < 8) {
        showToast('error', 'Password must be at least 8 characters!');
        document.getElementById('password').style.borderColor = 'var(--color-error)';
        return false;
    }

    // Check terms
    const terms = document.getElementById('terms');
    if (!terms.checked) {
        showToast('error', 'Please accept the Terms & Conditions!');
        terms.style.outline = '2px solid var(--color-error)';
        setTimeout(() => {
            terms.style.outline = 'none';
        }, 3000);
        return false;
    }

    // Show loading state
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating Account...';
    submitBtn.disabled = true;

    // Simulate API call
    setTimeout(() => {
        // Success
        submitBtn.innerHTML = '<i class="fas fa-check"></i> Account Created!';
        submitBtn.style.background = 'var(--color-success)';

        showToast('success', '🎉 Account created successfully! Welcome to OrviBazar!');

        // Reset form
        setTimeout(() => {
            submitBtn.innerHTML = originalText;
            submitBtn.style.background = '';
            submitBtn.disabled = false;
            // Redirect to home or dashboard
            // window.location.href = '/';
        }, 2000);
    }, 1500);

    return false;
}

// ============================================
// INPUT VALIDATION
// ============================================
document.addEventListener('DOMContentLoaded', function() {
    const inputs = document.querySelectorAll('input');

    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = 'var(--color-primary)';
            this.style.boxShadow = '0 0 0 3px rgba(26, 26, 26, 0.1)';
        });

        input.addEventListener('blur', function() {
            this.style.borderColor = 'var(--color-border-light)';
            this.style.boxShadow = 'none';

            if (this.hasAttribute('required') && !this.value.trim()) {
                this.style.borderColor = 'var(--color-error)';
            }
        });

        input.addEventListener('input', function() {
            if (this.hasAttribute('required') && this.value.trim()) {
                this.style.borderColor = 'var(--color-success)';
            }
        });
    });
});

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

// Add animations
const styleSheet = document.createElement("style");
styleSheet.textContent = `
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(30px);
        }
    }
`;
document.head.appendChild(styleSheet);
</script>

<style>
    /* Form input focus effects */
    .form-group input:focus {
        border-color: var(--color-primary) !important;
        box-shadow: 0 0 0 3px rgba(26, 26, 26, 0.1) !important;
    }
</style>
@endsection
