<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Show login page (uses guest layout)
     */
    public function login()
    {
        // If user is already logged in, redirect to home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Show register page (uses guest layout)
     */
    public function register()
    {
        // If user is already logged in, redirect to home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    /**
     * Show auth option page (uses guest layout)
     */
    public function option()
    {
        // If user is already logged in, redirect to home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.option');
    }

    /**
     * Handle login submission
     */
    public function loginSubmit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->only('email', 'remember'));
        }

        // Attempt to login
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            // Authentication successful
            $request->session()->regenerate();

            // Check if cart exists in session and move to database
            $this->syncSessionCartToDatabase();

            return redirect()->intended(route('home'))
                ->with('success', 'Welcome back, '.Auth::user()->name.'! 🎉');
        }

        // Authentication failed
        return back()
            ->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])
            ->withInput($request->only('email', 'remember'));
    }

    /**
     * Handle register submission
     */
    public function registerSubmit(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required|accepted',
        ], [
            'terms.required' => 'You must agree to the Terms of Service and Privacy Policy.',
            'terms.accepted' => 'You must agree to the Terms of Service and Privacy Policy.',
            'email.unique' => 'This email is already registered. Please login or use a different email.',
            'password.confirmed' => 'The password confirmation does not match.',
            'password.min' => 'Password must be at least 8 characters long.',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput($request->except('password', 'password_confirmation'));
        }

        // Create the user
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // Log the user in
            Auth::login($user);

            // Check if cart exists in session and move to database
            $this->syncSessionCartToDatabase();

            return redirect()->route('home')
                ->with('success', 'Welcome to OrviBazar, '.$user->name.'! 🎉 Your account has been created successfully.');

        } catch (\Exception $e) {
            return back()
                ->with('error', 'Something went wrong. Please try again.')
                ->withInput($request->except('password', 'password_confirmation'));
        }
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        // Get user name for goodbye message
        $userName = Auth::user()->name ?? 'User';

        // Logout the user
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        return redirect()->route('login')
            ->with('success', 'Goodbye, '.$userName.'! 👋 You have been logged out successfully.');
    }

    /**
     * Sync session cart to database after login
     */
    private function syncSessionCartToDatabase()
    {
        if (! Auth::check()) {
            return;
        }

        $sessionCart = Session::get('cart', []);

        if (empty($sessionCart)) {
            return;
        }

        // Get or create user's cart
        $cart = Cart::firstOrCreate([
            'user_id' => Auth::id(),
        ]);

        foreach ($sessionCart as $productId => $item) {
            // Check if item already exists in database cart
            $cartItem = CartItem::where('cart_id', $cart->id)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                // Update quantity if exists
                $cartItem->qty += $item['quantity'];
                $cartItem->price = $item['price'];
                $cartItem->save();
            } else {
                // Create new cart item
                CartItem::create([
                    'cart_id' => $cart->id,
                    'product_id' => $productId,
                    'product_variation_id' => null,
                    'qty' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
        }

        // Clear session cart after syncing
        Session::forget('cart');
    }
}
