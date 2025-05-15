<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use Illuminate\Http\Request;

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