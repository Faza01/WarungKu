<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // show data
    public function index()
    {
        $show = Category::all();

        // return $data;
        return response()->json([
            "message" => "Load data success",
            "data" => $show
        ], 200);
    }

    // add data
    public function store(Request $request)
    {
        $store = Category::create($request->all());
        
        // return $store;
        return response()->json([
            "message" => "Create data success",
            "data" => $store
        ], 200);
    }

    // Show by category
    public function show($id)
    {
        //
    }

    // Update data
    public function update(Request $request, $id)
    {
        $update = Category::where("id_category", $id)->update($request->all());
        
        // return $update;
         return response()->json([
            "message" => "Update data success",
            "data" => $update
        ], 200);
    }

    // Delete data
    public function destroy($id)
    {
        //
    }
}
