<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $promotions = [
            [
                'name' => 'Buy one get one free',
                'code' => 'BOGOF',
                'type' => 'number_of_items_validation',
                'value' => 2,
                'price_type' => 'percentage',
                'price_value' => '50',
                'description' => 'Get 50% off when you buy 2 items',
                'is_active' => 1,
            ],
            [
                'name' => 'Three for Two',
                'code' => '3FOR2',
                'type' => 'number_of_items_validation',
                'value' => 3,
                'price_type' => 'percentage',
                'price_value' => '33',
                'description' => 'Get 1 free when you buy 2 items',
                'is_active' => 1,
            ],
            [
                'name' => 'Buy 2 Get $1000 off',
                'code' => 'B21000OFF',
                'type' => 'number_of_items_validation',
                'value' => 2,
                'price_type' => 'fixed',
                'price_value' => '1000',
                'description' => 'When you buy 2 items, get $1000 off',
                'is_active' => 1,
            ],
        ];

        foreach ($promotions as $promotion) {
            \App\Models\Promotion::create($promotion);
        }
    }

    //add size id to the promotion one promotion can have multiple sizes should be compared using a pivot table.
}
