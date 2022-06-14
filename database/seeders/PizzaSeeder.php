<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pizzas = [
            [
                 'size_id' => 1,
                'name' => 'Original Pizza',
                'summary' => 'The classic Italian Pizza made with cheese and tomato sauce on our classic base.',
                'size' => 'small',
                'price' =>  8,
                'description' => 'The classic Italian Pizza made with toppings of Cheese and Tomato Sauce on a classic Italian base',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'pizza/1/image.png'
            ],

            [
                'size_id' => 2,
                'name' => 'Gimme The Meat ',
                'summary' => 'Pepperoni, ham, chicken, minced beef, sausage, bacon',
                'size' => 'small',
                'price' => 11,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat egestas faucibus. Cras elementum dui sed leo dapibus, ut pharetra lectus tempor. Ut tincidunt nisi quis tortor congue consequat. Mauris sit amet ante at odio aliquam malesuada id non dui. Mauris mollis erat a nibh varius, sit amet rhoncus nisi volutpat. Fusce et lacus ac nisi ultrices sagittis volutpat ac leo. Cras tortor tellus, venenatis condimentum tellus id, vulputate pharetra risus. ',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'pizza/2/image.png'
            ],

            [
                // 'size_id' => 1,
                'name' => 'Veggie Delight',
                'summary' => 'Onions, green peppers, mushrooms, sweetcorn.',
                'size' => 'small',
                'price' => 10,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat egestas faucibus. Cras elementum dui sed leo dapibus, ut pharetra lectus tempor. Ut tincidunt nisi quis tortor congue consequat. Mauris sit amet ante at odio aliquam malesuada id non dui. Mauris mollis erat a nibh varius, sit amet rhoncus nisi volutpat. Fusce et lacus ac nisi ultrices sagittis volutpat ac leo. Cras tortor tellus, venenatis condimentum tellus id, vulputate pharetra risus. ',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'pizza/3/image.png'
            ],

            [
                // 'size_id' => 1,
                'name' => 'Make Mine Hot',
                'summary' => 'Chicken, onions, green peppers, jalapeno peppers',
                'size' => 'small',
                'price' => 11,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat egestas faucibus. Cras elementum dui sed leo dapibus, ut pharetra lectus tempor. Ut tincidunt nisi quis tortor congue consequat. Mauris sit amet ante at odio aliquam malesuada id non dui. Mauris mollis erat a nibh varius, sit amet rhoncus nisi volutpat. Fusce et lacus ac nisi ultrices sagittis volutpat ac leo. Cras tortor tellus, venenatis condimentum tellus id, vulputate pharetra risus. ',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'pizza/4/image.png'
            ],

            [
                // 'size_id' => 1,
                'name' => 'Create Your Own Pizza',
                'summary' => 'Create your own pizza from a wide variety of our in house fresh ingredients with our original base',
                'size' => 'small',
                'price' => 8,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat egestas faucibus. Cras elementum dui sed leo dapibus, ut pharetra lectus tempor. Ut tincidunt nisi quis tortor congue consequat. Mauris sit amet ante at odio aliquam malesuada id non dui. Mauris mollis erat a nibh varius, sit amet rhoncus nisi volutpat. Fusce et lacus ac nisi ultrices sagittis volutpat ac leo. Cras tortor tellus, venenatis condimentum tellus id, vulputate pharetra risus. ',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'pizza/5/image.png'
            ],

            [
                //  'size_id' => 1,
                'name' => 'Make Mine Hot',
                'summary' => 'Chicken, onions, green peppers, jalapeno peppers',
                'size' => 'medium',
                'price' => 13,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque volutpat egestas faucibus. Cras elementum dui sed leo dapibus, ut pharetra lectus tempor. Ut tincidunt nisi quis tortor congue consequat. Mauris sit amet ante at odio aliquam malesuada id non dui. Mauris mollis erat a nibh varius, sit amet rhoncus nisi volutpat. Fusce et lacus ac nisi ultrices sagittis volutpat ac leo. Cras tortor tellus, venenatis condimentum tellus id, vulputate pharetra risus. ',
                'is_active' => 1,
                'is_featured' => 1,
                'sort_order' => 0,
                'image' => 'pizza/4/image.png'
            ]
        ];

        foreach ($pizzas as $pizza) {
            \App\Models\Pizza::create($pizza);
        }
    }
    }

