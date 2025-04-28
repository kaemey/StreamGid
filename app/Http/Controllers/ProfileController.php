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
        checkAuth();
        $user = Auth::user();
        $timing = timing($user->form);

        $user = $user->toArray();
        return view('profile.index', compact('user', 'timing'));
    }
    public function edit()
    {
        checkAuth();
        $user = Auth::user();
        $form = $user->form;
        $timing = timing($form);

        foreach ($timing as $key => $value) {
            if ($value[1] == "-")
                $timing[$key][1] = "";
            if ($value[2] == "-")
                $timing[$key][2] = "";
        }

        $user = $user->toArray();
        $user['active'] = $form['active'];
        return view('profile.edit', compact('user', 'timing'));
    }
    public function update(Request $request)
    {
        checkAuth();
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        $user = Auth::user();
        $request = $request->toArray();

        $timing = "";

        for ($i = 1; $i <= 7; $i++) {
            if (isset($request['time:' . $i . ':0'])) {
                $timing .= $i . ':1:' . $request['time:' . $i . ':1'] . ':' . $request['time:' . $i . ':2'] . ';';
            } else {
                $timing .= $i . ':0:' . $request['time:' . $i . ':1'] . ':' . $request['time:' . $i . ':2'] . ';';
            }
        }

        $active = '0';
        if (isset($request['active']))
            $active = '1';

        $userData = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
        ];

        $user->update($userData);
        $user->form->update(['timing' => $timing, 'active' => $active]);

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
        $this->checkAuth();
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