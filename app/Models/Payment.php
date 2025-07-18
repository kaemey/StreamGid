<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Voronkovich\SberbankAcquiring\OrderStatus;
use Voronkovich\SberbankAcquiring\ClientFactory;
use Voronkovich\SberbankAcquiring\Currency;
use Voronkovich\SberbankAcquiring\HttpClient\GuzzleAdapter;
use GuzzleHttp\Client as Guzzle;

class Payment extends Model
{
    protected $guarded = false;
    protected $client;
    protected $returnUrl;
    protected $failUrl;
    protected $currency;
    protected static function booted()
    {
        static::created(function ($payment) {
            $payment->returnUrl = route("paymentSuccess", $payment->order->id);
            $payment->failUrl = route("paymentFail", $payment->order->id);
            $payment->currency = Currency::RUB;

            $payment->client = ClientFactory::sberbankTest([
                'userName' => config('sberbank.username'),
                'password' => config('sberbank.password'),
                'language' => 'ru',
                'currency' => $payment->currency,
                'httpClient' => new GuzzleAdapter(new Guzzle()),
            ]);
        });
    }

    public function execute()
    {
        $params['currency'] = $this->currency;
        $params['failUrl'] = $this->failUrl;

        $result = $this->client->registerOrder($this->order->id, $this->order->amount, $this->returnUrl, $params);

        $paymentOrderId = $result['orderId'];
        $paymentFormUrl = $result['formUrl'];

        return redirect($paymentFormUrl);
    }

    public function getOrderStatus(Order $order)
    {
        $result = $this->client->getOrderStatus($order->id);

        if (OrderStatus::isDeposited($result['orderStatus'])) {
            return "Order #$order->id is deposited!";
        }

        if (OrderStatus::isDeclined($result['orderStatus'])) {
            return "Order #$order->id was declined!";
        }
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}