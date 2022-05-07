<?php

namespace Database\Seeders;

use App\Models\Category;
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
            'name' => Category::BOOTS,
            'discount' => 0.3, // Products in the boots category have a 30% discount.
        ], [
            'name' => Category::SANDALS,
            'discount' => 0,
        ], [
            'name' => Category::SNEAKERS,
            'discount' => 0,
        ]]);
    }
}
