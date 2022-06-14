<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PizzaAddon extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'name',
        'size',
        'toppings',
        'value',
        'is_active',
        'is_featured',
    ];
    public function pizza(){
        return $this->belongsTo(Pizza::class);
    }

}
