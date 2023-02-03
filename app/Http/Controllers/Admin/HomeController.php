<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;

class HomeController
{
    public function index()
    {
        return view('home');
    }

    public function landingPage()
    {
        if (Auth::user()) {
            return redirect()->route('admin.home');
        } else {
            return view('landing-page');
        }
    }
}
