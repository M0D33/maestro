<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizzaAddonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizza_addons =[
        [
            'pizza_id' => 1,
            'name' => 'cheese',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 1,
            'name' => 'tomato sauce',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 2,
            'name' => 'cheese',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 2,
            'name' => 'tomato sauce',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 2,
            'name' => 'pepperoni',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 2,
            'name' => 'ham',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 2,
            'name' => 'chicken',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 2,
            'name' => 'Minced beef',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 2,
            'name' => 'sausage',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 2,
            'name' => 'bacon',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],

        [
            'pizza_id' => 5,
            'name' => 'ham',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 5,
            'name' => 'chicken',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 5,
            'name' => 'bacon',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 5,
            'name' => 'Minced beef',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 5,
            'name' => 'cheese',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 5,
            'name' => 'tomato sauce',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],    [
            'pizza_id' => 5,
            'name' => 'pepperoni',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 5,
            'name' => 'Minced beef',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 5,
            'name' => 'Onions',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 5,
            'name' => 'Green peppers',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],
        [
            'pizza_id' => 5,
            'name' => 'Mushrooms',
            'value' => '0.9',
            'is_active' => 'is_active',
        ],

    ];
    foreach ($pizza_addons as $pizza_addon) {
        \App\Models\PizzaAddon::create($pizza_addon);
    }

    }
}
