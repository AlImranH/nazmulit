<?php

namespace App\Http\Controllers;

use App\Models\ItemModel;
use Illuminate\Http\Request;
use Throwable;

class ItemModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemModel = ItemModel::get();
        return response()->json($itemModel);
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
            'category_id' => 'required|max:255',
            'brand_id' => 'required|max:255',
            'name' => 'required|max:255',

        ]);

        try{
            $itemModel = ItemModel::create($validated);
            return response()->json(['model'=> $itemModel, 'success' => "Model has been created successfylly"]);

        }
        catch(Throwable $e){
            return response("Model has been created successfylly".$e->getMessage(), 500)->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ItemModel = ItemModel::findOrFail($id);
        return response()->json($ItemModel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemModel $itemModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'category_id' => 'required|max:255',
            'brand_id' => 'required|max:255',
            'name' => 'required|max:255',
        ]);
        ItemModel::find($id)->update($validated);

        return response()->json('Success', 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ItemModel::where('id', $id)->delete();
        return response()->json('success', 200);
    }
}
