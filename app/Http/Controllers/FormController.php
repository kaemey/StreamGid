<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

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
        checkAuth();
        $form = Form::find($id);
        $streamer = $form->user;
        $timing = timing($form);
        return view('order', compact('timing', 'streamer'));
    }

    public function sendOrder(Request $request)
    {
        $data = $request->toArray();
        Order::create([
            'streamer_id' => $data['streamer_id'],
            'user_id' => Auth::user()->id,
            'day' => $data['day'],
            'description' => $data['description']
        ]);
        return redirect()->route('orderSuccess');
    }

    public function orderSuccess()
    {
        return view('ordersuccess');
    }
}