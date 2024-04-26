<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;
use Throwable;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::get();
        return response()->json($brand);
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
            'name' => 'required|max:255|unique:brands,name',

        ]);
        try{
            $brand = Brand::create($validated);
            $brand->category()->attach($request->category_id);

            return response()->json(['brand'=> $brand, 'success' => "Brand has been created successfylly"]);

        }
        catch(Throwable $e){
            return response("Brand has been created successfylly".$e->getMessage(), 500)->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $brand = Brand::where('id', $id)->with('category')->first();
        return response()->json(['brand'=>$brand, 'category'=>$brand->category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $brand = Brand::where('id',$id)->first();

        $brand->name = $request->name;
        $brand->save();
        $brand->category()->sync($request->category_id);

        return response()->json('Success', 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Brand::where('id', $id)->delete();
        return response()->json('success', 200);
    }
}
