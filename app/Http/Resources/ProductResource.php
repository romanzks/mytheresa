<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    const DEFAULT_CURRENCY = 'EUR';

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
                'discount_percentage' => $this->price_discount_percentage > 0
                    ? sprintf('%s%%', $this->price_discount_percentage * 100)
                    : null,
                'currency' => self::DEFAULT_CURRENCY, // price.currency is always EUR
            ],
        ];

    }
}
