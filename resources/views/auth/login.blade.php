@extends('layouts.guest')

@section('title', 'Login - OrviBazar')

@section('content')
<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: var(--color-bg-light); padding: var(--spacing-xl) var(--container-padding);">
    <div style="width: 100%; max-width: 440px;">

        <!-- Logo / Brand -->
        <div style="text-align: center; margin-bottom: var(--spacing-xl);">
            <a href="/" style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-primary); text-decoration: none; display: inline-flex; align-items: center; gap: var(--spacing-sm);">
                <i class="fas fa-store" style="color: var(--color-accent); font-size: 32px;"></i>
                OrviBazar
            </a>
            <p style="color: var(--color-text-muted); margin-top: var(--spacing-xs); font-size: var(--font-size-sm);">
                Sign in to your account
            </p>
        </div>

        <!-- Login Card -->
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

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.submit') }}">
                @csrf

                <!-- Email -->
                <div style="margin-bottom: var(--spacing-lg);">
                    <label for="email" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); color: var(--color-text-secondary);">
                        <i class="fas fa-envelope" style="margin-right: var(--spacing-xs);"></i>
                        Email Address
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
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
                <div style="margin-bottom: var(--spacing-md);">
                    <label for="password" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); color: var(--color-text-secondary);">
                        <i class="fas fa-lock" style="margin-right: var(--spacing-xs);"></i>
                        Password
                    </label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" required
                            style="width: 100%; padding: 12px 16px; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); background: var(--color-off-white);"
                            onfocus="this.style.borderColor='var(--color-accent)'; this.style.boxShadow='0 0 0 3px rgba(232,168,56,0.15)'"
                            onblur="this.style.borderColor='var(--color-border-light)'; this.style.boxShadow='none'"
                            placeholder="Enter your password">
                        <button type="button" onclick="togglePassword()"
                            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--color-text-muted); cursor: pointer; font-size: var(--font-size-base);">
                            <i class="fas fa-eye" id="passwordToggleIcon"></i>
                        </button>
                    </div>
                    @error('password')
                        <div style="color: var(--color-error); font-size: var(--font-size-sm); margin-top: var(--spacing-xs);">
                            <i class="fas fa-exclamation-circle"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: var(--spacing-lg);">
                    <label style="display: flex; align-items: center; gap: var(--spacing-sm); font-size: var(--font-size-sm); color: var(--color-text-muted); cursor: pointer;">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} style="accent-color: var(--color-accent); width: 16px; height: 16px; cursor: pointer;">
                        Remember me
                    </label>
                    <a href="#" style="font-size: var(--font-size-sm); color: var(--color-accent); text-decoration: none; font-weight: var(--font-weight-medium);">
                        Forgot password?
                    </a>
                </div>

                <!-- Login Button -->
                <button type="submit"
                    style="width: 100%; background: var(--color-primary); color: white; border: none; padding: 14px; border-radius: var(--radius-md); font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-base); display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm);"
                    onmouseover="this.style.background='var(--color-primary-light)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--shadow-md)'"
                    onmouseout="this.style.background='var(--color-primary)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                    <i class="fas fa-sign-in-alt"></i>
                    Sign In
                </button>
            </form>

            <!-- Divider -->
            <div style="display: flex; align-items: center; gap: var(--spacing-md); margin: var(--spacing-xl) 0;">
                <div style="flex: 1; height: 1px; background: var(--color-border-light);"></div>
                <span style="color: var(--color-text-muted); font-size: var(--font-size-sm); font-weight: var(--font-weight-medium);">OR</span>
                <div style="flex: 1; height: 1px; background: var(--color-border-light);"></div>
            </div>

            <!-- Google Login Option -->
            <a href="{{ url('auth/google') }}"
                style="display: flex; align-items: center; justify-content: center; gap: var(--spacing-md); width: 100%; padding: 12px; background: white; border: 2px solid var(--color-border-light); border-radius: var(--radius-md); text-decoration: none; color: var(--color-text-primary); font-weight: var(--font-weight-medium); transition: all var(--transition-fast);"
                onmouseover="this.style.background='var(--color-off-white)'; this.style.borderColor='var(--color-accent)'; this.style.transform='translateY(-2px)'; this.style.boxShadow='var(--shadow-md)'"
                onmouseout="this.style.background='white'; this.style.borderColor='var(--color-border-light)'; this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt="Google" style="width: 24px; height: 24px;">
                <span>Continue with Google</span>
            </a>

            <!-- Register Link -->
            <div style="text-align: center; margin-top: var(--spacing-lg); color: var(--color-text-muted); font-size: var(--font-size-sm);">
                Don't have an account?
                <a href="{{ route('register') }}" style="color: var(--color-accent); text-decoration: none; font-weight: var(--font-weight-semibold);">
                    Sign up now
                    <i class="fas fa-arrow-right" style="margin-left: var(--spacing-xs);"></i>
                </a>
            </div>
        </div>

        <!-- Footer Text -->
        <div style="text-align: center; margin-top: var(--spacing-lg); color: var(--color-text-muted); font-size: var(--font-size-xs);">
            <i class="fas fa-shield-alt" style="margin-right: var(--spacing-xs);"></i>
            Secure login powered by OrviBazar
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
</script>
@endsection