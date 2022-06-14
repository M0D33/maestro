<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = [
    'name',
    'code',
    'type',
    'value',
    'price_type',
    'price_value',
    'description',
    'image',
    'is_active',
];
}
