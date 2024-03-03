<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TempPurchaseDetails extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_no', 'category_id', 'brand_id', 'model_id', 'specifications', 'qty', 'unit_price', 'sales_price', 'serial_arr', 'warranty', 'total_amount'];

    protected $casts = ['serial_arr' => 'array'];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function brand(): HasOne
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function model(): HasOne
    {
        return $this->hasOne(ItemModel::class, 'id', 'model_id');
    }
}
