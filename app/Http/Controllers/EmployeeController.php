<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Throwable;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|max:255',
            'nid' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'designation' => 'required',
            'salary' => 'required',
            'joining_date' => 'required',
            'gender' => 'required',
            'address' => 'required',

        ]);

            // return $validated;

            try{
                $employee = Employee::create($validated);

                return response("Employee has been created successfylly", 200)->header('Content-Type', 'text/plain');

            }
            catch(Throwable $e){
                return response("Employee has been created successfylly".$e->getMessage(), 500)->header('Content-Type', 'text/plain');
            }

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'full_name' => 'required|max:255',
            'nid' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'designation' => 'required',
            'salary' => 'required',
            'joining_date' => 'required',
            'gender' => 'required',
            'address' => 'required',
        ]);
        Employee::find($id)->update($validated);

        return response()->json('Success', 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Employee::where('id', $id)->delete();
        return response()->json('success', 200);
    }
}
