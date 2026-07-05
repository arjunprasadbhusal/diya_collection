<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'shipping_address_1',
        'shipping_address_2',
        'shipping_city',
        'shipping_postal_code',
        'payment_method',
        'status',
        'currency',
        'subtotal',
        'tax',
        'total',
        'items_count',
        'items',
        'notes',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
