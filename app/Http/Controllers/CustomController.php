<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\ItemModel;

class CustomController extends Controller
{
    public function getBrandByCategory($categoryId){
        $category = Category::where('id', $categoryId)->first();
        // $brand = Brand::where('category_id', $categoryId)->get();
        return $category->brand;
    }

    public function getModelByBrand($brandId){
        $model = ItemModel::where('brand_id', $brandId)->get();
        return $model;
    }
}
