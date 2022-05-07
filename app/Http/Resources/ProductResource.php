<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    private function getDiscountPercentage($discountPercentage)
    {
        return $discountPercentage > 0
            ? sprintf('%s%%', $discountPercentage * 100)
            : null;
    }

    public function toArray($request)
    {
        // When a product does not have a discount, price.final and
        // price.original should be the same number and discount_percentage
        // should be null.

        // When a product has a discount price.original is the original price,
        // price.final is the amount with the discount applied and
        // discount_percentage represents the applied discount with the % sign.

        return [
            'sku' => $this->sku,
            'name' => $this->name,
            'category' => $this->category->name,
            'price' => [
                'original' => $this->price,
                'final' => $this->price_final,
                'discount_percentage' => 
                    $this->getDiscountPercentage($this->price_discount_percentage),
                'currency' => Product::DEFAULT_CURRENCY,
            ],
        ];

    }
}
