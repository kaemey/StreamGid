<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class YooKassaWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();

        $factory = new \YooKassa\Model\Notification\NotificationFactory();
        $notificationObject = $factory->factory($data);
        $responseObject = $notificationObject->getObject();

        // Логируем для отладки
        Log::info('YooKassa webhook received', $data);

        $payment = Payment::where(["service_payment_id" => $responseObject->paymentId])->first();

        if (!$payment->client->isNotificationIPTrusted($_SERVER['REMOTE_ADDR'])) {
            header('HTTP/1.1 400 Something went wrong');
            exit();
        }

        $payment->update(["status" => $notificationObject->getEvent()]);

        if ($notificationObject->getEvent() === \YooKassa\Model\Notification\NotificationEventType::PAYMENT_SUCCEEDED) {
            $someData = [
                'paymentId' => $responseObject->getId(),
                'paymentStatus' => $responseObject->getStatus(),
            ];
            // Специфичная логика
            // ...
        } elseif ($notificationObject->getEvent() === \YooKassa\Model\Notification\NotificationEventType::PAYMENT_WAITING_FOR_CAPTURE) {
            $someData = [
                'paymentId' => $responseObject->getId(),
                'paymentStatus' => $responseObject->getStatus(),
            ];
            // Специфичная логика
            // ...
        } elseif ($notificationObject->getEvent() === \YooKassa\Model\Notification\NotificationEventType::PAYMENT_CANCELED) {
            $someData = [
                'paymentId' => $responseObject->getId(),
                'paymentStatus' => $responseObject->getStatus(),
            ];
            // Специфичная логика
            // ...
        } elseif ($notificationObject->getEvent() === \YooKassa\Model\Notification\NotificationEventType::REFUND_SUCCEEDED) {
            $someData = [
                'refundId' => $responseObject->getId(),
                'refundStatus' => $responseObject->getStatus(),
                'paymentId' => $responseObject->getPaymentId(),
            ];
            // ...
            // Специфичная логика
        } else {
            header('HTTP/1.1 400 Something went wrong');
            exit();
        }

        return response()->json(['status' => 'ok']);
    }
}
