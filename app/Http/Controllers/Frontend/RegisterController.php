<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
