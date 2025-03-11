<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class FormController extends Controller
{
    //
    public function index($id)
    {
        $user = Form::find($id)->user->toArray();

        return view('form', compact('user'));
    }
}