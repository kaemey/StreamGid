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

    private function checkAuth()
    {
        if (!(Auth::check())) {
            header('Location: ' . route('home'));
            die();
        }
    }

    private function timing($user)
    {
        $timingData = explode(';', $user['timing']);
        $timing = [];
        foreach ($timingData as $dayData) {
            $day = explode(':', $dayData);
            switch ($day[0]) {
                case 1:
                    $timing['ПН'][0] = true;
                    if ($day[1] == '-') {
                        $timing['ПН'][0] = false;
                    }
                    $timing['ПН'][1] = $day[1];
                    $timing['ПН'][2] = $day[2];
                case 2:
                    $timing['ВТ'][0] = true;
                    if ($day[1] == '-') {
                        $timing['ВТ'][0] = false;
                    }
                    $timing['ВТ'][1] = $day[1];
                    $timing['ВТ'][2] = $day[2];
                case 3:
                    $timing['СР'][0] = true;
                    if ($day[1] == '-') {
                        $timing['СР'][0] = false;
                    }
                    $timing['СР'][1] = $day[1];
                    $timing['СР'][2] = $day[2];
                case 4:
                    $timing['ЧТ'][0] = true;
                    if ($day[1] == '-') {
                        $timing['ЧТ'][0] = false;
                    }
                    $timing['ЧТ'][1] = $day[1];
                    $timing['ЧТ'][2] = $day[2];
                case 5:
                    $timing['ПТ'][0] = true;
                    if ($day[1] == '-') {
                        $timing['ПТ'][0] = false;
                    }
                    $timing['ПТ'][1] = $day[1];
                    $timing['ПТ'][2] = $day[2];
                case 6:
                    $timing['СБ'][0] = true;
                    if ($day[1] == '-') {
                        $timing['СБ'][0] = false;
                    }
                    $timing['СБ'][1] = $day[1];
                    $timing['СБ'][2] = $day[2];
                case 7:
                    $timing['ВС'][0] = true;
                    if ($day[1] == '-') {
                        $timing['ВС'][0] = false;
                    }
                    $timing['ВС'][1] = $day[1];
                    $timing['ВС'][2] = $day[2];
            }
        }
        return $timing;
    }

    public function index()
    {
        $this->checkAuth();
        $user = Auth::user()->toArray();

        $timing = $this->timing($user);

        return view('profile.index', compact('user', 'timing'));
    }
    public function edit()
    {
        $this->checkAuth();
        $user = Auth::user()->toArray();
        $timing = $this->timing($user);

        return view('profile.edit', compact('user', 'timing'));
    }
    public function update(Request $request)
    {
        $this->checkAuth();
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);
        $user = Auth::user();
        $request = $request->toArray();
        $data = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
        ];

        $timing = "";

        for ($i = 1; $i <= 7; $i++) {
            $timing .= $i . ':' . $request['time:' . $i . ':1'] . ':' . $request['time:' . $i . ':2'] . ';';
        }

        $data['timing'] = $timing;

        User::where('id', $user->id)->update($data);
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