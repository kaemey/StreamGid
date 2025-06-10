<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    //
    protected $guarded = false;

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}