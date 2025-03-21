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

    private function timing($form)
    {
        $timingData = explode(';', $form->timing);
        $timing = [];
        foreach ($timingData as $dayData) {
            $day = explode(':', $dayData);
            switch ($day[0]) {
                case 1:
                    $timing['ПН'][0] = true;
                    if ($day[1] == '0') {
                        $timing['ПН'][0] = false;
                    }
                    $timing['ПН'][1] = $day[2];
                    $timing['ПН'][2] = $day[3];
                case 2:
                    $timing['ВТ'][0] = true;
                    if ($day[1] == '0') {
                        $timing['ВТ'][0] = false;
                    }
                    $timing['ВТ'][1] = $day[2];
                    $timing['ВТ'][2] = $day[3];
                case 3:
                    $timing['СР'][0] = true;
                    if ($day[1] == '0') {
                        $timing['СР'][0] = false;
                    }
                    $timing['СР'][1] = $day[2];
                    $timing['СР'][2] = $day[3];
                case 4:
                    $timing['ЧТ'][0] = true;
                    if ($day[1] == '0') {
                        $timing['ЧТ'][0] = false;
                    }
                    $timing['ЧТ'][1] = $day[2];
                    $timing['ЧТ'][2] = $day[3];
                case 5:
                    $timing['ПТ'][0] = true;
                    if ($day[1] == '0') {
                        $timing['ПТ'][0] = false;
                    }
                    $timing['ПТ'][1] = $day[2];
                    $timing['ПТ'][2] = $day[3];
                case 6:
                    $timing['СБ'][0] = true;
                    if ($day[1] == '0') {
                        $timing['СБ'][0] = false;
                    }
                    $timing['СБ'][1] = $day[2];
                    $timing['СБ'][2] = $day[3];
                case 7:
                    $timing['ВС'][0] = true;
                    if ($day[1] == '0') {
                        $timing['ВС'][0] = false;
                    }
                    $timing['ВС'][1] = $day[2];
                    $timing['ВС'][2] = $day[3];
            }
        }
        return $timing;
    }

    public function index()
    {
        $this->checkAuth();
        $user = Auth::user();
        $timing = $this->timing($user->form);

        $user = $user->toArray();
        return view('profile.index', compact('user', 'timing'));
    }
    public function edit()
    {
        $this->checkAuth();
        $user = Auth::user();
        $form = $user->form;
        $timing = $this->timing($form);

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
        $this->checkAuth();
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