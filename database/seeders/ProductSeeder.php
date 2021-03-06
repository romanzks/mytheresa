<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([[
            'sku' => '000001',
            'name' => 'BV Lean leather ankle boots',
            'category_id' => DB::table('categories')->where('name', Category::BOOTS)->first()->id,
            'price' => 89000,
            'discount' => 0,
        ], [
            'sku' => '000002',
            'name' => 'BV Lean leather ankle boots',
            'category_id' => DB::table('categories')->where('name', Category::BOOTS)->first()->id,
            'price' => 99000,
            'discount' => 0,
        ], [
            'sku' => '000003',
            'name' => 'Ashlington leather ankle boots',
            'category_id' => DB::table('categories')->where('name', Category::BOOTS)->first()->id,
            'price' => 71000,
            'discount' => 0.15, // The product with sku = 000003 has a 15% discount.
        ], [
            'sku' => '000004',
            'name' => 'Naima embellished suede sandals',
            'category_id' => DB::table('categories')->where('name', Category::SANDALS)->first()->id,
            'price' => 79500,
            'discount' => 0,
        ], [
            'sku' => '000005',
            'name' => 'Nathane leather sneakers',
            'category_id' => DB::table('categories')->where('name', Category::SNEAKERS)->first()->id,
            'price' => 59000,
            'discount' => 0,
        ]]);
    }
}
