<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
    protected $fillable = [
        'user_id',
        'payment_method',
        'merchandise_total',
        'shipping_fee',
        'total_payment',
    ];

    protected $table = 'orders'; // or whatever your real table name is
}
