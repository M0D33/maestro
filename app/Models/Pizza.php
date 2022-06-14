<?php

namespace App\Models;

use App\Filters\PizzaFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    use HasFactory;


    protected $fillable = [
        // 'size_id',
        'name',
        'summary',
        'size',
        'toppings',
        'price',
        'description',
        'image',
        'is_active',
        'is_featured',
        'sort_order',
    ];

    public function scopeFilter(Builder $builder, $request)
    {
        return (new PizzaFilter($request))->filter($builder);
    }

    public function pizzaAddons(){
        return $this->hasMany(PizzaAddon::class, 'pizza_id');
    }

    // public function Size(){
    //     return $this->hasMany(Size::class, 'pizza_id');
    // }



}
