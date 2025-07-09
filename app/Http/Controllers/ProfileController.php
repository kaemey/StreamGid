<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\City;
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
        if ($user->isStreamer == "true") {
            $categories = Category::all();
            $timing = timing($user->form);
            $user->categories = explode(",", $user->form->categories);
            return view('profile.streamer.index', compact('user', 'timing', 'categories'));
        } else {
            return view('profile.index', compact('user'));
        }

    }
    public function edit()
    {
        checkAuth();
        $user = Auth::user();

        if ($user->isStreamer == "true") {
            $cities = City::all();
            $categories = Category::all();
            $form = $user->form;
            $timing = timing($form);

            foreach ($timing as $key => $value) {
                if ($value[1] == "-")
                    $timing[$key][1] = "";
                if ($value[2] == "-")
                    $timing[$key][2] = "";
            }

            $user['active'] = $form['active'];
            $user["categories"] = explode(",", $form["categories"]);
            return view('profile.streamer.edit', compact('user', 'timing', 'categories', 'cities'));
        } else {
            return view('profile.edit', compact('user', ));
        }

    }
    public function update(Request $request)
    {

        checkAuth();
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'city_id' => 'required'
        ]);

        $user = Auth::user();
        $request = $request->toArray();

        if ($user->isStreamer == "true") {
            //Обновление расписания
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

            $user->form->update(['timing' => $timing, 'active' => $active, 'city_id' => $request["city_id"]]);
            //Обновление категорий
            if (isset($request["categories"]))
                $user->form->update(["categories" => implode(",", $request["categories"])]);

        }

        $userData = [
            'name' => $request['name'],
            'phone' => $request['phone'],
            'email' => $request['email'],
        ];

        $user->update($userData);

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
        checkAuth();
        $request->validate([
            'avatar' => 'required|image',
        ]);
        $userData = Auth::user();
        $imageName = $userData['id'] . '.jpg';
        $request->avatar->move(public_path('storage/avatars/'), $imageName);
        User::where('id', $userData['id'])->update(['avatar' => 'storage/avatars/' . $userData['id'] . '.jpg']);

        return redirect()->route('profile');
    }
}