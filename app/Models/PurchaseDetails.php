<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetails extends Model
{
    use HasFactory;

    protected $casts = ['serial_arr' => 'array'];

    protected $fillable = ['invoice_no', 'category_id', 'brand_id', 'model_id', 'specifications', 'qty', 'unit_price', 'sales_price', 'serial_arr', 'warranty', 'total_amount'];

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
