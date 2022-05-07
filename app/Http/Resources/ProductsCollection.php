<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductsCollection extends ResourceCollection
{
    public static $wrap = 'products';

    public function toArray($request)
    {
        return ProductResource::collection($this->collection);
    }
}
