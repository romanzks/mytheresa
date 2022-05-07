<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BootsDiscountTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([CategorySeeder::class]);

        DB::table('products')->insert([[
            'sku' => '000001',
            'name' => 'BV Lean leather ankle boots',
            'category_id' => DB::table('categories')->where('name', Category::BOOTS)->first()->id,
            'price' => 89000,
            'discount' => 0,
        ]]);
    }
}
