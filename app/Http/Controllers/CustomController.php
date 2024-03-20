<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\ItemModel;

class CustomController extends Controller
{
    public function getBrandByCategory($categoryId){
        $brand = Brand::where('category_id', $categoryId)->get();
        return $brand;
    }

    public function getModelByBrand($brandId){
        $model = ItemModel::where('brand_id', $brandId)->get();
        return $model;
    }
}
