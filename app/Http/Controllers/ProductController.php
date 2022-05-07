<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductsCollection;

class ProductController extends Controller
{
    // Must return at most 5 elements
    const LIMIT = 5;

    public function index(Request $request)
    {
        $products = Product::query();

        // Can be filtered by category as a query string parameter
        if ($request->has('category')) {
            $products->whereHas('category', function($query) use ($request) {
                $query->where('name', $request->category);
            })->get();
        }

        // Can be filtered by priceLessThan as a query string parameter,
        // this filter applies before discounts are applied and will show
        // products with prices lesser than or equal the value provided
        if ($request->has('priceLessThan')) {
            $products->where('price', '<=', $request->priceLessThan);
        }

        return new ProductsCollection($products->limit(self::LIMIT)->get());
    }
}
