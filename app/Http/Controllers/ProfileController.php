<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $userData = Auth::user();
        $user = [
            'id' => $userData['id'],
            'name' => $userData['name'],
            'phone' => $userData['phone'],
            'isStreamer' => $userData['isStreamer'],
            'email' => $userData['email'],
            'avatar' => $userData['avatar'],
        ];

        return view('profile.index', compact('user'));
    }
    public function auth()
    {
        return view('profile.auth');
    }
    public function reg()
    {
        return view('profile.reg');
    }
}