<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use App\Models\User;

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
    public function edit()
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

        return view('profile.edit', compact('user'));
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);
        $userData = Auth::user();
        $request = $request->toArray();
        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
        ];
        User::where('id', $userData['id'])->update($data);
        return redirect()->route('profile');
    }
    public function auth()
    {
        return view('profile.auth');
    }
    public function reg()
    {
        return view('profile.reg');
    }
    public function upload_avatar(Request $request): RedirectResponse
    {
        $request->validate([
            'avatar' => 'required|image',
        ]);
        $userData = Auth::user();
        $imageName = $userData['id'] . '.' . $request->avatar->extension();
        $request->avatar->move(public_path('storage/avatars/'), $imageName);
        User::where('id', $userData['id'])->update(['avatar' => 'storage/avatars/' . $userData['id'] . '.jpg']);

        return redirect()->route('profile');
    }
}