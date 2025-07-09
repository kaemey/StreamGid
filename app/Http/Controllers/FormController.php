<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
    //
    public function index($id)
    {
        $categories = Category::all();
        $form = Form::find($id);
        $user = $form->user;
        $user['about'] = $form->about;
        $user['form_id'] = $form->id;
        $user['categories'] = explode(",", $form->categories);

        $timing = timing($form);

        return view('form', compact('user', 'timing', 'categories'));
    }

    public function order($id)
    {
        checkAuth();
        $form = Form::find($id);
        $streamer = $form->user;
        $timing = timing($form);
        return view('order', compact('timing', 'streamer'));
    }

    public function orderSuccess()
    {
        return view('ordersuccess');
    }
}