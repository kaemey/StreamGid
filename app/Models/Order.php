<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    //
    use HasFactory;
    protected $guarded = false;

    protected static function booted()
    {
        static::created(function ($order) {
            $payment = Payment::create([
                "order_id" => $order->id,
                "amount_value" => $order->streamer->form->amount
            ]);
            $order->update(["payment_id" => $payment->id]);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function streamer()
    {
        return $this->belongsTo(User::class, 'streamer_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }
}
