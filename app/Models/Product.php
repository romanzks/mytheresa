<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // price.currency is always EUR
    const DEFAULT_CURRENCY = 'EUR';

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    function getPriceDiscountPercentageAttribute()
    {
        // When multiple discounts collide, the biggest discount must be applied.
        return max($this->discount, $this->category->discount);
    }

    function getPriceFinalAttribute()
    {
        return $this->price - $this->price * $this->getPriceDiscountPercentageAttribute();
    }
}
