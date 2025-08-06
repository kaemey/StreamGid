<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded = false;
    protected static function booted()
    {
        static::created(function ($payment) {
            $payment->client = new \YooKassa\Client(new \YooKassa\Client\CurlClient());
            $payment->client->setAuth(config("yookassa.ShopID"), config("yookassa.SecretKey"));
            // или Auth-токен
            // $payment->client->setAuthToken(config("yookassa.AuthToken"));
            $userAgent = $payment->client->getApiClient()->getUserAgent();
            $userAgent->setFramework('Laravel', '11.31');
        });
    }

    public function createPaymentRequest()
    {
        try {
            $idempotenceKey = uniqid('', true);
            $response = $this->client->createPayment(
                [
                    'amount' => [
                        'value' => $this->amount_value,
                        'currency' => 'RUB',
                    ],
                    'confirmation' => [
                        'type' => 'redirect',
                        'locale' => 'ru_RU',
                        'return_url' => route("paymentSuccess"),
                    ],
                    'capture' => true,
                    'description' => 'Заказ №' . $this->order->id,
                    'receipt' => [
                        'customer' => [
                            'full_name' => 'Kuzyukov Maksim Aleksandrovich',
                            'email' => 'krosto97@yandex.ru',
                            'phone' => '+79522017630',
                            'inn' => '784001971355'
                        ],
                        'items' => [
                            [
                                'description' => 'Услуги проведения онлайн-экскурсии',
                                'quantity' => '1.00',
                                'amount' => [
                                    'value' => $this->amount_value,
                                    'currency' => 'RUB'
                                ],
                                'vat_code' => '1',
                                'payment_mode' => 'full_payment',
                                'payment_subject' => 'service',
                            ],
                        ]
                    ]
                ],
                $idempotenceKey
            );

            //получаем confirmationUrl для дальнейшего редиректа
            $confirmationUrl = $response->getConfirmation()->getConfirmationUrl();
        } catch (\Exception $e) {
            $response = $e;
        }

        if (!empty($response)) {
            Log::error('YooKassa createPaymentRequest error', $response);
            print_r($response);
        }

        return redirect($confirmationUrl);
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}