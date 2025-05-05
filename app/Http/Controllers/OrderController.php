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
        $ordersData = Order::where(["user_id" => Auth::user()->id])->get();
        $orders = [];

        foreach ($ordersData as $order) {
            $streamer = User::find($order['streamer_id']);
            $timing = timing($streamer->form);

            $orders[] = [
                "streamer_name" => $streamer->name,
                "day" => getStringDay($order['day']),
                "time" => $timing[getShortStringDay($order['day'])],
                "streamer_id" => $streamer->id,
                "status" => getStringOrderStatus($order['status'])
            ];
        }

        return view('order.list', compact('orders'));
    }
}