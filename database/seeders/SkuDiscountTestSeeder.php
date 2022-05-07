<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SkuDiscountTestSeeder extends Seeder
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
            'sku' => '000003',
            'name' => 'Ashlington leather ankle boots',
            'category_id' => DB::table('categories')->where('name', Category::SANDALS)->first()->id,
            'price' => 71000,
            'discount' => 0.15, // The product with sku = 000003 has a 15% discount.
        ], [
            'sku' => '000004',
            'name' => 'Ashlington leather ankle boots',
            'category_id' => DB::table('categories')->where('name', Category::SANDALS)->first()->id,
            'price' => 71000,
            'discount' => 0,
        ]]);
    }
}
