<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class VueApiController extends Controller
{
    public function products()
    {
        $products = Product::where('status', 1)->with('productVariantPrices')->get();
        return response($products);
    }

    public function productCategories()
    {
        $product_categories = ProductCategory::where('status', 1)->get();
        return response($product_categories);
    }

    public function productBrands()
    {
        $product_brands = ProductBrand::where('status', 1)->get();
        return response($product_brands);
    }
}
