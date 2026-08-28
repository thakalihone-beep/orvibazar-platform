@extends('layouts.guest')

@section('title', 'Register - OrviBazar')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: var(--color-bg-light); padding: var(--spacing-xl) var(--container-padding);">
    <div style="width: 100%; max-width: 480px;">

        <!-- Logo / Brand -->
        <div style="text-align: center; margin-bottom: var(--spacing-xl);">
            <a href="/" style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-primary); text-decoration: none; display: inline-flex; align-items: center; gap: var(--spacing-sm);">
                <i class="fas fa-store" style="color: var(--color-accent); font-size: 32px;"></i>
                OrviBazar
            </a>
            <p style="color: var(--color-text-muted); margin-top: var(--spacing-xs); font-size: var(--font-size-sm);">
                Create your account to start shopping
            </p>
        </div>

        <!-- Register Card -->
        <div style="background: white; border-radius: var(--radius-xl); padding: var(--spacing-2xl); box-shadow: var(--shadow-lg);">

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div style="background: var(--color-success); color: white; padding: var(--spacing-md); border-radius: var(--radius-md); margin-bottom: var(--spacing-lg); display: flex; align-items: center; gap: var(--spacing-sm);">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background: var(--color-error); color: white; padding: var(--spacing-md); border-radius: var(--radius-md); margin-bottom: var(--spacing-lg); display: flex; align-items: center; gap: var(--spacing-sm);">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div style="background: var(--color-error); color: white; padding: var(--spacing-md); border-radius: var(--radius-md); margin-bottom: var(--spacing-lg);">
                    @foreach($errors->all() as $error)
                        <div style="display: flex; align-items: center; gap: var(--spacing-sm); padding: 2px 0;">
                            <i class="fas fa-times-circle"></i>
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Register Form -->
            <form method="POST" action="{{ route('register.submit') }}">
                @csrf

                <!-- Name -->
                <div style="margin-bottom: var(--spacing-lg);">
                    <label for="name" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); color: var(--color-text-secondary);">
                        <i class="fas fa-user" style="margin-right: var(--spacing-xs);"></i>
                        Full Name
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus
                        style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); background: var(--color-off-white);"
                        onfocus="this.style.borderColor='var(--color-accent)'; this.style.boxShadow='0 0 0 3px rgba(232,168,56,0.15)'"
                        onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                        placeholder="John Doe">
                    @error('name')
                        <div style="color: var(--color-error); font-size: var(--font-size-sm); margin-top: var(--spacing-xs);">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Email -->
                <div style="margin-bottom: var(--spacing-lg);">
                    <label for="email" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); color: var(--color-text-secondary);">
                        <i class="fas fa-envelope" style="margin-right: var(--spacing-xs);"></i>
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); background: var(--color-off-white);"
                        onfocus="this.style.borderColor='var(--color-accent)'; this.style.boxShadow='0 0 0 3px rgba(232,168,56,0.15)'"
                        onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                        placeholder="your@email.com">
                    @error('email')
                        <div style="color: var(--color-error); font-size: var(--font-size-sm); margin-top: var(--spacing-xs);">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: var(--spacing-lg);">
                    <label for="password" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); color: var(--color-text-secondary);">
                        <i class="fas fa-lock" style="margin-right: var(--spacing-xs);"></i>
                        Password
                    </label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" required
                            style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); background: var(--color-off-white);"
                            onfocus="this.style.borderColor='var(--color-accent)'; this.style.boxShadow='0 0 0 3px rgba(232,168,56,0.15)'"
                            onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                            placeholder="At least 8 characters">
                        <button type="button" onclick="togglePassword()"
                            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--color-text-muted); cursor: pointer; font-size: var(--font-size-base);">
                            <i class="fas fa-eye" id="passwordToggleIcon"></i>
                        </button>
                    </div>
                    <div style="margin-top: var(--spacing-xs); display: flex; align-items: center; gap: var(--spacing-sm); font-size: var(--font-size-xs); color: var(--color-text-muted);">
                        <i class="fas fa-info-circle"></i>
                        <span>Must be at least 8 characters long</span>
                        <span id="passwordStrength" style="font-weight: var(--font-weight-semibold); margin-left: auto;"></span>
                    </div>
                    @error('password')
                        <div style="color: var(--color-error); font-size: var(--font-size-sm); margin-top: var(--spacing-xs);">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div style="margin-bottom: var(--spacing-lg);">
                    <label for="password_confirmation" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); color: var(--color-text-secondary);">
                        <i class="fas fa-check-circle" style="margin-right: var(--spacing-xs);"></i>
                        Confirm Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); background: var(--color-off-white);"
                        onfocus="this.style.borderColor='var(--color-accent)'; this.style.boxShadow='0 0 0 3px rgba(232,168,56,0.15)'"
                        onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                        placeholder="Confirm your password">
                </div>

                <!-- Terms & Conditions -->
                <div style="margin-bottom: var(--spacing-lg);">
                    <label style="display: flex; align-items: flex-start; gap: var(--spacing-sm); font-size: var(--font-size-sm); color: var(--color-text-muted); cursor: pointer;">
                        <input type="checkbox" name="terms" {{ old('terms') ? 'checked' : '' }} style="accent-color: var(--color-accent); width: 16px; height: 16px; cursor: pointer; margin-top: 2px;">
                        <span>
                            I agree to the
                            <a href="#" style="color: var(--color-accent); text-decoration: none; font-weight: var(--font-weight-medium);">Terms of Service</a>
                            and
                            <a href="#" style="color: var(--color-accent); text-decoration: none; font-weight: var(--font-weight-medium);">Privacy Policy</a>
                        </span>
                    </label>
                    @error('terms')
                        <div style="color: var(--color-error); font-size: var(--font-size-sm); margin-top: var(--spacing-xs);">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Register Button -->
                <button type="submit"
                    style="width: 100%; background: var(--color-accent); color: var(--color-primary); border: none; padding: 14px; border-radius: var(--radius-md); font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-base); display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm);"
                    onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--shadow-glow)'"
                    onmouseout="this.style.background='var(--color-accent)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <i class="fas fa-user-plus"></i>
                    Create Account
                </button>
            </form>

            <!-- Divider -->
            <div style="display: flex; align-items: center; gap: var(--spacing-md); margin: var(--spacing-xl) 0;">
                <div style="flex: 1; height: 1px; background: var(--color-border-light);"></div>
                <span style="color: var(--color-text-muted); font-size: var(--font-size-sm); font-weight: var(--font-weight-medium);">OR</span>
                <div style="flex: 1; height: 1px; background: var(--color-border-light);"></div>
            </div>

            <!-- Google Register Option -->
            <a href="{{ url('auth/google') }}"
                style="display: flex; align-items: center; justify-content: center; gap: var(--spacing-md); width: 100%; padding: 12px; background: white; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); text-decoration: none; color: var(--color-text-primary); font-weight: var(--font-weight-medium); transition: all var(--transition-fast);"
                onmouseover="this.style.background='var(--color-off-white)'; this.style.borderColor='var(--color-accent)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--shadow-md)'"
                onmouseout="this.style.background='white'; this.style.borderColor='var(--color-border-light)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 24px; height: 24px;">
                <span>Continue with Google</span>
            </a>

            <!-- Login Link -->
            <div style="text-align: center; margin-top: var(--spacing-lg); color: var(--color-text-muted); font-size: var(--font-size-sm);">
                Already have an account?
                <a href="{{ route('login') }}" style="color: var(--color-accent); text-decoration: none; font-weight: var(--font-weight-semibold);">
                    Sign in
                    <i class="fas fa-arrow-right" style="margin-left: var(--spacing-xs);"></i>
                </a>
            </div>
        </div>

        <!-- Footer Text -->
        <div style="text-align: center; margin-top: var(--spacing-lg); color: var(--color-text-muted); font-size: var(--font-size-xs);">
            <i class="fas fa-shield-alt" style="margin-right: var(--spacing-xs);"></i>
            Your data is safe and secure with OrviBazar
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const icon = document.getElementById('passwordToggleIcon');
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.className = 'fas fa-eye-slash';
    } else {
        passwordInput.type = 'password';
        icon.className = 'fas fa-eye';
    }
}

// Password strength indicator
document.getElementById('password')?.addEventListener('input', function() {
    const password = this.value;
    const strength = document.getElementById('passwordStrength');
    if (!strength) return;

    let score = 0;
    if (password.length >= 8) score++;
    if (password.match(/[a-z]/)) score++;
    if (password.match(/[A-Z]/)) score++;
    if (password.match(/[0-9]/)) score++;
    if (password.match(/[^a-zA-Z0-9]/)) score++;

    const messages = ['Weak', 'Fair', 'Good', 'Strong', 'Very Strong'];
    const colors = ['var(--color-error)', 'var(--color-warning)', 'var(--color-info)', 'var(--color-success)', 'var(--color-success)'];

    strength.textContent = password.length > 0 ? messages[score] : '';
    strength.style.color = password.length > 0 ? colors[score] : '';
});
</script>
@endsection