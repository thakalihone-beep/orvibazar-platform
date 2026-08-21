<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\VendorRegistrationNotification;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function option()
    {
        return view('frontend.registration.option');
    }

    public function vendor()
    {
        return view('frontend.registration.vendor');
    }

    public function customer()
    {
        return view('frontend.registration.customer');
    }

    public function service()
    {
        return view('frontend.registration.terms-of-service');
    }

    public function policy()
    {
        return view('frontend.registration.privacy-policy');
    }

    public function agreement()
    {
        return view('frontend.registration.agreement');
    }

    public function store(Request $request)
    {
        // ============================================
        // VALIDATION
        // ============================================

        $validated = $request->validate([

            // Personal Information
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
                'unique:vendors,email',
            ],

            'contact' => 'required|string|max:20',

            // Business Information
            'shop_name' => 'required|string|max:255',

            'pan_no' => [
                'required',
                'string',
                'max:50',
                'unique:vendors,pan_no',
            ],

            'description' => 'nullable|string|max:1000',

            // Shop Images
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'banner' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',

            // Terms
            'terms' => 'accepted',
        ]);

        // ============================================
        // CREATE USER
        // ============================================

        $user = User::create([
            'name' => $validated['first_name'].' '.$validated['last_name'],
            'email' => $validated['email'],
            'phone' => $validated['contact'],

            // Temporary password.
            // Vendor will set/change their password later.
            'password' => Hash::make(Str::random(32)),
        ]);

        // ============================================
        // UPLOAD LOGO
        // ============================================

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store(
                'vendors/logos',
                'public'
            );
        }

        // ============================================
        // UPLOAD BANNER
        // ============================================

        $bannerPath = null;

        if ($request->hasFile('banner')) {
            $bannerPath = $request->file('banner')->store(
                'vendors/banners',
                'public'
            );
        }

        // ============================================
        // CREATE VENDOR
        // ============================================

        $vendor = Vendor::create([
            'name' => $validated['first_name'].' '.$validated['last_name'],

            'user_id' => $user->id,

            'shop_name' => $validated['shop_name'],

            'slug' => Str::slug($validated['shop_name']).'-'.$user->id,

            'contact' => $validated['contact'],

            'email' => $validated['email'],

            'pan_no' => $validated['pan_no'],

            'logo' => $logoPath,

            'banner' => $bannerPath,

            'description' => $validated['description'] ?? null,

            'status' => 'pending',

            'commission_rate' => 0,

            'approved_at' => null,
        ]);

        // ============================================
        // 4. SEND NOTIFICATION (Optional)
        // ============================================
        // You can send email notification here
        Mail::to('thakalihone@gmail.com')->send(new VendorRegistrationNotification($vendor));

        // ============================================
        // REDIRECT
        // ============================================

        return redirect()
            ->route('vendor')
            ->with(
                'success',
                'Your vendor application has been submitted successfully. Our admin team will review your application.'
            );
    }
}
