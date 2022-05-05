<?php

namespace Database\Seeders;

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
            'category_id' => 1,
            'price' => 89000,
            'discount' => 0,
        ]]);
    }
}
