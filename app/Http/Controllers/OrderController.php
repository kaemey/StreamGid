<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\ChatController;
use App\Models\Message;

class OrderController extends Controller
{
    //
    public function orderList()
    {
        $user = Auth::user();

        if ($user->isStreamer == "true") {
            $orders = Order::where(["streamer_id" => $user->id])->get();

            return view('order.streamer.list', compact('orders'));

        } else {
            $orders = Order::where(["user_id" => $user->id])->get();

            foreach ($orders as $order) {
                $timing = timing($order->streamer->form);
                $order->time = $timing[getShortStringDay($order['day'])];
            }
            return view('order.list', compact('orders'));
        }
    }

    public function sendOrder(Request $request)
    {
        $data = $request->toArray();
        Order::create([
            'streamer_id' => $data['streamer_id'],
            'status' => 0,
            'user_id' => Auth::user()->id,
            'day' => $data['day'],
            'description' => $data['description']
        ]);

        $userId = Auth::user()->id;

        // Создаем чат между пользователем 1 и 2
        $chat = ChatController::getOrCreateChat($userId, $data['streamer_id']);

        // Отправляем сообщение
        Message::create([
            'chat_id' => $chat->id,
            'from_id' => $userId,
            'to_id' => $data['streamer_id'],
            'text' => 'Добрый день! Я заказал у вас стрим!',
        ]);

        return redirect()->route('orderSuccess');
    }

    public function acceptOrder($id)
    {
        $user = Auth::user();
        $order = Order::find($id);
        if ($order->streamer_id == $user->id) {
            $order->update(["status" => 1]);
        }
        return redirect()->route("orderList");
    }
    public function cancelOrder($id)
    {
        $user = Auth::user();
        $order = Order::find($id);
        if ($order->streamer_id == $user->id) {
            $order->update(["status" => 2]);
        }
        if ($order->user_id == $user->id) {
            $order->update(["status" => 3]);
        }
        return redirect()->route("orderList");
    }

    public function payOrder(Order $order)
    {
        $user = Auth::user();

        if ($order->user_id == $user->id) {
            return view("order.payorder");
        } else {
            return redirect()->route("auth");
        }

    }

    public function sendReviewPoint($id, Request $request)
    {
        $order = Order::find($id);
        $order->update(['review_point' => $request['rating']]);
        $order->streamer->form->recalculate_rating($request['rating']);
        return redirect()->route("orderList");
    }
}