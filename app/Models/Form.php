<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;

class Form extends Model
{
    //
    use HasFactory;
    protected $guarded = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function recalculate_rating($review_point)
    {
        $ordersWithReview = Order::where([["streamer_id", "=", $this->id], ["review_point", "!=", null]])->count();
        $newRate = ($this->rate + $review_point) / $ordersWithReview;
        $this->update(["rate" => $newRate]);
    }
}
