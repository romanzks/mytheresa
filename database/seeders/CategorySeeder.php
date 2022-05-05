<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        DB::table('categories')->insert([[
            'id' => 1,
            'name' => 'boots',
            'discount' => 0.3, // Products in the boots category have a 30% discount.
        ], [
            'id' => 2,
            'name' => 'sandals',
            'discount' => 0,
        ], [
            'id' => 3,
            'name' => 'sneakers',
            'discount' => 0,
        ]]);
    }
}
