<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $fillable = ['category_id','brand_id','model_id','specifications','qty','total_amount'];

    public function details()
    {
        return $this->hasMany(StockDetails::class, 'stock_id');
    }
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

    public static function updateStock($datas, $type)
    {
        $date = Carbon::now();
        $items = [];
        $items[] = [
            'category_id' => $datas[0]['category_id'],
            'brand_id' => $datas[0]['brand_id'],
            'model_id' => $datas[0]['model_id'],
            'specifications' => $datas[0]['specifications'],
            'qty' => $datas[0]['qty'],
            'unit_price' => $datas[0]['unit_price'],
            'sales_price' => $datas[0]['sales_price'],
            // 'warranty' => $datas[0]['warranty'],
            'total_amount' => $datas[0]['total_amount']
        ];
        $i = 0;
        foreach ($datas as $data){

            if($items[$i]['category_id'] == $data['category_id'] & $items[$i]['brand_id'] == $data['brand_id'] & $items[$i]['model_id'] == $data['model_id'] & $items[$i]['specifications'] == $data['specifications']) continue;

            $i++;
            $items[$i] = $data;
        }
//        return $items;
        foreach ($items as $item){
            $matchCase = [
                'category_id' => $item['category_id'],
                'brand_id' => $item['brand_id'],
                'model_id' => $item['model_id'],
                'specifications' => $item['specifications']
            ];
            $stockData = self::where($matchCase)->first();
//            return $stockData;
            if($stockData != null){
                $qty = $stockData->qty;
                $amount = $stockData->total_amount;
                $stock = $stockData->update([
                    'qty' => $qty + $item['qty'],
                    'total_amount' => $amount + $item['total_amount']
                ]);

                switch ($type){
                    case 'purchase':
                        $item['stock_id'] = $stockData->id;
                        $item['opening_qty'] = $qty;
                        $item['purchase_qty'] = $item['qty'];
                        $item['date'] = Carbon::parse($date)->format('Y/m/d');
                        StockDetails::create($item);
                        break;
                }
            }else{
                $stock = self::create($item);
                switch ($type){
                    case 'purchase':
                        $item['stock_id'] = $stock->id;
                        $item['opening_qty'] = $stock->qty;
                        $item['purchase_qty'] = $item['qty'];
                        $item['date'] = Carbon::parse($date)->format('Y/m/d');
                        StockDetails::create($item);
                        break;
                }

            }
        }
    }
}
