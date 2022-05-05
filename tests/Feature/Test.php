<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\BootsDiscountTestSeeder;
use Database\Seeders\SkuDiscountTestSeeder;
use Database\Seeders\DiscountCollisionTestSeeder;
use Tests\TestCase;

class Test extends TestCase
{
    use RefreshDatabase;

    /**
     * Returns a list of Product with the given discounts applied when necessary
     */
    public function test_list_of_products()
    {
        $this->seed();

        $response = $this->get('/products');

        $response
            ->assertStatus(200)
            ->assertExactJson([[
                'sku' => '000001',
                'name' => 'BV Lean leather ankle boots',
                'category' => 'boots',
                'price' => [
                    'original' => 89000,
                    'final' => 62300,
                    'discount_percentage' => '30%',
                    'currency' => 'EUR',
                ],
            ], [
                'sku' => '000002',
                'name' => 'BV Lean leather ankle boots',
                'category' => 'boots',
                'price' => [
                    'original' => 99000,
                    'final' => 69300,
                    'discount_percentage' => '30%',
                    'currency' => 'EUR',
                ],
            ], [
                'sku' => '000003',
                'name' => 'Ashlington leather ankle boots',
                'category' => 'boots',
                'price' => [
                    'original' => 71000,
                    'final' => 49700,
                    'discount_percentage' => '30%',
                    'currency' => 'EUR',
                ],
            ], [
                'sku' => '000004',
                'name' => 'Naima embellished suede sandals',
                'category' => 'sandals',
                'price' => [
                    'original' => 79500,
                    'final' => 79500,
                    'discount_percentage' => null,
                    'currency' => 'EUR',
                ],
            ], [
                'sku' => '000005',
                'name' => 'Nathane leather sneakers',
                'category' => 'sneakers',
                'price' => [
                    'original' => 59000,
                    'final' => 59000,
                    'discount_percentage' => null,
                    'currency' => 'EUR',
                ],
            ]]);
    }

    /**
     * Products in the boots category have a 30% discount
     */
    public function test_boots_discount()
    {
        $this->seed(BootsDiscountTestSeeder::class);

        $response = $this->get('/products');

        $response
            ->assertStatus(200)
            ->assertExactJson([[
                'sku' => '000001',
                'name' => 'BV Lean leather ankle boots',
                'category' => 'boots',
                'price' => [
                    'original' => 89000,
                    'final' => 62300,
                    'discount_percentage' => '30%',
                    'currency' => 'EUR',
                ],
            ]]);
    }

    /**
     * The product with sku = 000003 has a 15% discount
     */
    public function test_sku_discount()
    {
        $this->seed(SkuDiscountTestSeeder::class);

        $response = $this->get('/products');

        $response
            ->assertStatus(200)
            ->assertExactJson([[
                'sku' => '000003',
                'name' => 'Ashlington leather ankle boots',
                'category' => 'sandals',
                'price' => [
                    'original' => 71000,
                    'final' => 60350,
                    'discount_percentage' => '15%',
                    'currency' => 'EUR',
                ],
            ], [
                'sku' => '000004',
                'name' => 'Ashlington leather ankle boots',
                'category' => 'sandals',
                'price' => [
                    'original' => 71000,
                    'final' => 71000,
                    'discount_percentage' => null,
                    'currency' => 'EUR',
                ],
            ]]);
    }

    /**
     * When multiple discounts collide, the biggest discount must be applied
     */
    public function test_discount_collision()
    {
        $this->seed(DiscountCollisionTestSeeder::class);

        $response = $this->get('/products');

        $response
            ->assertStatus(200)
            ->assertExactJson([[
                'sku' => '000006',
                'name' => 'Naima embellished suede sandals',
                'category' => 'boots',
                'price' => [
                    'original' => 71000,
                    'final' => 49700,
                    'discount_percentage' => '30%',
                    'currency' => 'EUR',
                ],
            ], [
                'sku' => '000007',
                'name' => 'Nathane leather sneakers',
                'category' => 'boots',
                'price' => [
                    'original' => 71000,
                    'final' => 39050,
                    'discount_percentage' => '45%',
                    'currency' => 'EUR',
                ],
            ]]);
    }

    /**
     * Must return at most 5 elements
     */
    public function test_return_at_most_5_elements()
    {
        $this->seed();
        // $this->seed(DiscountCollisionTestSeeder::class);
        
        $response = $this->get('/products');

        $response
            ->assertStatus(200)
            ->assertJsonCount(5);
    }

    /**
     * Can be filtered by category as a query string parameter
     */
    public function test_category_filter()
    {
        $this->seed();
        
        $response = $this->get('/products?category=sandals');

        $response
            ->assertStatus(200)
            ->assertExactJson([[
                'sku' => '000004',
                'name' => 'Naima embellished suede sandals',
                'category' => 'sandals',
                'price' => [
                    'original' => 79500,
                    'final' => 79500,
                    'discount_percentage' => null,
                    'currency' => 'EUR',
                ],
            ]]);
    }

    /**
     * Can be filtered by priceLessThan as a query string parameter,
     * this filter applies before discounts are applied and will show products
     * with prices lesser than or equal the value provided
     */
    public function test_price_less_than_filter()
    {
        $this->seed();
        
        $response = $this->get('/products?priceLessThan=75000');

        $response
            ->assertStatus(200)
            ->assertExactJson([[
                'sku' => '000003',
                'name' => 'Ashlington leather ankle boots',
                'category' => 'boots',
                'price' => [
                    'original' => 71000,
                    'final' => 49700,
                    'discount_percentage' => '30%',
                    'currency' => 'EUR',
                ],
            ], [
                'sku' => '000005',
                'name' => 'Nathane leather sneakers',
                'category' => 'sneakers',
                'price' => [
                    'original' => 59000,
                    'final' => 59000,
                    'discount_percentage' => null,
                    'currency' => 'EUR',
                ],
            ]]);
    }
}
