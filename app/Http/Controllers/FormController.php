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

        return view('form', compact('user'));
    }
}