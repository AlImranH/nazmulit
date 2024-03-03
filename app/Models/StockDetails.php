<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockDetails extends Model
{
    use HasFactory;

    protected $fillable = ['stock_id','opening_qty','close_qty','purchase_qty','purchase_return_qty','sales_qty','sales_return_qty','date'];

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function model()
    {
        return $this->hasOne(ItemModel::class, 'id', 'model_id');
    }
}
