<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    //
    public function index($id)
    {
        $form = Form::find($id);
        $user = $form->user->toArray();
        $user['about'] = $form->about;
        $user['form_id'] = $form->id;

        $timing = timing($form);

        return view('form', compact('user', 'timing'));
    }

    public function order($id)
    {
        $form = Form::find($id);
        $user = $form->user;
        $timing = timing($form);
        return view('order', compact('timing', 'user'));
    }
}