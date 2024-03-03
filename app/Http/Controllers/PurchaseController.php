<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Models\Stock;
use App\Models\TempPurchase;
use App\Models\TempPurchaseDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchase = Purchase::with('details', 'supplier')->get();
        return response()->json($purchase);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $purchase = Purchase::with('details', 'supplier')->get();
        return response()->json($purchase);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $purchaseData = $request->all();
        $tempPurchaseDetailsData = TempPurchaseDetails::all();


        $purchaseDetailsData = [];
        $itemArr = [];
        $totalAmount = 0;
        DB::beginTransaction();
        try {


        foreach ($tempPurchaseDetailsData as $data){

            $purchaseDetailsData = [
                'invoice_no' => $data->invoice_no,
                'category_id' => $data->category_id,
                'brand_id' => $data->brand_id,
                'model_id' => $data->model_id,
                'specifications' => $data->specifications,
                'qty' => $data->qty,
                'unit_price' => $data->unit_price,
                'sales_price' => $data->sales_price,
                'serial_arr' => $data->serial_arr,
                'warranty' => $data->warranty,
                'total_amount' => $data->total_amount
            ];

            PurchaseDetails::create($purchaseDetailsData);

            $totalAmount += $data->total_amount;
            foreach ($data->serial_arr as $serial){
                $itemArr[] = [
                    'category_id' => $data->category_id,
                    'brand_id' => $data->brand_id,
                    'model_id' => $data->model_id,
                    'specifications' => $data->specifications,
                    'qty' => $data->qty,
                    'unit_price' => $data->unit_price,
                    'sales_price' => $data->sales_price,
                    'serial' => $serial,
                    'warranty' => $data->warranty,
                    'total_amount' => $data->total_amount
                ];
            }
        }

        $purchaseData['total_amount'] = $totalAmount;

//        return $itemArr;
//        return $purchaseDetailsData;

            Purchase::create($purchaseData);

            Product::insert($itemArr);
            Stock::updateStock($itemArr, 'purchase');
//            return Stock::updateStock($itemArr, 'purchase');

            DB::commit();
            TempPurchase::truncate();
            TempPurchaseDetails::truncate();
            return response("Purchase has been created successfully", 200)->header('Content-Type', 'text/plain');
        }
        catch (\Throwable $e){
            DB::rollBack();
            return response("Something went wrong".$e->getMessage(), 500)->header('Content-Type', 'text/plain');
        }



//        return $itemArr;


    }

    /**
     * Display the specified resource.
     */
    public function show($invoice)
    {
        $purchase = PurchaseDetails::where('invoice_no', $invoice)->with('category', 'brand','model')->get();
        return response()->json($purchase);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    public function purchaseDetails($invoice)
    {
        $details = Purchase::where('invoice_no', $invoice)->with('details')->get();
        return response()->json($details);
    }
}
