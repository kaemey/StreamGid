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

        $query = Form::where('id', '>', 0);

        if (isset($request['city'])) {
            $query->where(["city_id" => $request['city']]);
        }

        if (isset($request['reviews'])) {
            if ($request['reviews'] == "with") {
                $query->where("rate", ">", 0);
            } elseif ($request['reviews'] == "without") {
                $query->where("rate", "=", 0);
            } elseif ($request['reviews'] == "hight") {
                $query->where("rate", ">=", 4);
            }
        }

        $formsTemp = $query->get();
        $forms = collect();

        if (isset($request['category'])) {
            foreach ($formsTemp as $formTemp) {
                $catsInForm = explode(',', $formTemp->categories);
                if (in_array($request['category'], $catsInForm)) {
                    $forms = $forms->push($formTemp);
                }
            }
        } else {
            $forms = $formsTemp;
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
                    'rate' => $form->rate
                ];
            }

        }

        return view('main', compact('formsData'));
    }

    public function politica()
    {
        return view('politica');
    }

    public function contacts()
    {
        return view('contacts');
    }
}
