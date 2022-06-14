<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'user_id',
        'promotion_id',
        'status',
        'payment_status',
        'address_1',
        'address_2',
        'city',
        'postcode',
        'county',
        'phone',
        'mobile',
        'discount',
        'delivery_method',
        'total',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
