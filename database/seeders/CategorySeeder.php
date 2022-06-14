<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'category_id' => 1,
                'name' => 'Small',
                'summary' => 'The classic Italian Pizza.',
                'is_active' => 'is_active',
            ],


        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}

