<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Form;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $request = $request->toArray();

        if (isset($request['city'])) {
            $forms = Form::find(["city_id" => $request['city']]);
        } else {
            $forms = Form::all();
        }

        $formsData = [];
        foreach ($forms as $form) {

            if ($form->active == "1") {
                $user = $form->user;
                $formsData[] = [
                    'city' => City::find($form['city_id'])->name,
                    'photo' => $user->avatar,
                    'username' => $user->name,
                    'id' => $form->id,
                    'rate' => $user->rate
                ];
            }

        }

        return view('main', compact('formsData'));
    }
}