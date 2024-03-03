<?php

namespace App\Http\Controllers;

use App\Models\TempPurchase;
use App\Models\TempPurchaseDetails;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class TempPurchaseDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TempPurchaseDetails::with('category', 'brand', 'model')->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $invoiceNo = $data['invoice']['invoice_no'];
        $data['product']['invoice_no'] = $invoiceNo;

        DB::beginTransaction();
        try {
            if(TempPurchase::where('invoice_no', $data['invoice']['invoice_no'])->count() == 1){
                TempPurchaseDetails::create($data['product']);
            }else{
                TempPurchase::create($data['invoice']);
                TempPurchaseDetails::create($data['product']);
            }

            DB::commit();
        }
        catch (Throwable $e){
            DB::rollBack();
            return response("Something went wrong".$e->getMessage(), 500)->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TempPurchaseDetails $tempPurchaseDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TempPurchaseDetails $tempPurchaseDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TempPurchaseDetails $tempPurchaseDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        TempPurchaseDetails::where('id', $id)->delete();
        return response()->json('success', 200);
    }
}
