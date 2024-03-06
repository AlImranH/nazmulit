<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Throwable;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supplier = Supplier::get();
        return response()->json($supplier);
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
        $validated = $request->validate([
            'name' => 'required|max:255',
            'mobile' => 'required',
            'email' => 'required|email',
            'web' => 'url',
            'address' => 'required',

        ]);

            // return $validated;

            try{
                Supplier::create($validated);

                return response("Supplier has been created successfylly", 200)->header('Content-Type', 'text/plain');

            }
            catch(Throwable $e){
                return response("Supplier has been created successfylly".$e->getMessage(), 500)->header('Content-Type', 'text/plain');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json($supplier);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'mobile' => 'required',
            'email' => 'required|email',
            'web' => 'url:http,https',
            'address' => 'required',

        ]);
        Supplier::find($id)->update($validated);

        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Supplier::where('id', $id)->delete();
        return response()->json('success', 200);
    }
}
