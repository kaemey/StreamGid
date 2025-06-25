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

        $haveCity = isset($request['city']);
        $haveCategory = isset($request['category']);

        $forms = collect();

        if ($haveCategory) {
            if ($haveCity) {
                $formsTemp = Form::where(["city_id" => $request['city']])->get();
                foreach ($formsTemp as $formTemp) {
                    $catsInForm = explode(',', $formTemp->categories);
                    if (in_array($request['category'], $catsInForm))
                        $forms = $forms->push($formTemp);
                }
            } else {
                $formsTemp = Form::All();
                foreach ($formsTemp as $formTemp) {
                    $catsInForm = explode(',', $formTemp->categories);
                    if (in_array($request['category'], $catsInForm)) {
                        $forms = $forms->push($formTemp);
                    }

                }
            }
        } else {
            if ($haveCity) {
                $forms = Form::where(["city_id" => $request['city']])->get();
            } else {
                $forms = Form::All();
            }
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