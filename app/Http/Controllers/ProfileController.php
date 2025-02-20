<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
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