<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DiscountCollisionTestSeeder extends Seeder
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
            'sku' => '000006',
            'name' => 'Naima embellished suede sandals',
            'category_id' => 1,
            'price' => 71000,
            'discount' => 0.15, // sku discount less than category discount
        ], [
            'sku' => '000007',
            'name' => 'Nathane leather sneakers',
            'category_id' => 1,
            'price' => 71000,
            'discount' => 0.45, // sku discount greater than category discount
        ]]);
    }
}
