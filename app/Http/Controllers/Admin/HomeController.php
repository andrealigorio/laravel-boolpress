<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function profile()
    {
        return view('admin.user.profile');
    }

    public function generate_token() 
    {
        $api_token = Str::random(50);
        $user = Auth::user();
        $user->api_token = $api_token;
        $user->save();

        return redirect()->route('admin.profile');
    }
}
