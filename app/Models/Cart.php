<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total',
        'is_paid',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pizzas()
    {
        return $this->belongsToMany(Pizza::class, 'cart_pizza')
            ->withPivot([
                'quantity',
                'price',
                'total',
                'addons',
            ]);
    }
}
