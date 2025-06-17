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
        checkAuth();
        $user = Auth::user();

        if ($user->isStreamer == "true") {
            $ordersData = Order::where(["streamer_id" => Auth::user()->id])->get();

            $orders = [];
            foreach ($ordersData as $order) {
                $userData = User::find($order['user_id']);

                $orders[] = [
                    "id" => $order->id,
                    "user_name" => $userData->name,
                    "user_phone" => $userData->phone,
                    "day" => getStringDay($order['day']),
                    "description" => $order['description'],
                    "status" => $order['status'],
                    "string_status" => getStringOrderStatusForStreamer($order['status']),
                    "payment_status_string" => getStringPaymentStatus($order['payment_status'])
                ];
            }

            return view('order.streamer.list', compact('orders'));

        } else {
            $ordersData = Order::where(["user_id" => Auth::user()->id])->get();
            $orders = [];

            foreach ($ordersData as $order) {
                $streamer = User::find($order['streamer_id']);
                $timing = timing($streamer->form);
                $orders[] = [
                    "id" => $order->id,
                    "streamer_name" => $streamer->name,
                    "day" => getStringDay($order['day']),
                    "time" => $timing[getShortStringDay($order['day'])],
                    "streamer_id" => $streamer->id,
                    "status" => $order['status'],
                    "string_status" => getStringOrderStatusForUser($order['status']),
                    "payment_status_string" => getStringPaymentStatus($order['payment_status'])
                ];

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
        checkAuth();
        $user = Auth::user();
        $order = Order::find($id);
        if ($order->streamer_id == $user->id) {
            $order->update(["status" => 1]);
        }
        return redirect()->route("orderList");
    }
    public function cancelOrder($id)
    {
        checkAuth();
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

    public function payOrder($id)
    {
        checkAuth();
        $user = Auth::user();
        $order = Order::find($id);

        if ($order->user_id == $user->id) {
            return view("order.payorder");
        } else {
            return redirect()->route("auth");
        }

    }
}