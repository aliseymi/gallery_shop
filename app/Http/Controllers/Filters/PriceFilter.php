<?php

namespace App\Http\Controllers\Filters;

use App\Models\Product;

class PriceFilter
{
    public function findByPriceRange($range)
    {
        return Product::whereBetween('price', explode('to', $range))->get();
    }
}