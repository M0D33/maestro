<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [

                [
                   'name' => 'Original Pizza',
                   'size' => 'small',
                   'is_active' => 1,
               ],
               [
               'name' => 'Gimme The Meat',
               'size' => 'small',
               'is_active' => 1,
           ],
        ];

        foreach ($sizes as $size) {
            \App\Models\Size::create($size);
        }

    }
}
