<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['serial','category_id','brand_id','model_id','specifications','buying_price','sales_price','qty'];


    public function brand(){
        return $this->hasMany(Brand::class, 'id', 'brand_id');
    }

    public function model(){
        return $this->hasMany(ItemModel::class, 'id', 'model_id');
    }


}
