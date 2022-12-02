<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // show data
    public function index()
    {
        $show = Product::all();

        // return $data;
        return response()->json([
            "message" => "Load data success",
            "data" => $show
        ], 200);
    }

    // add data
    public function store(Request $request)
    {
        $store = Product::create($request->all());
        
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
        $update = Product::where("id_product", $id)->update($request->all());
        
        // return $update;
         return response()->json([
            "message" => "Update data success",
            "data" => $update
        ], 200);
    }

    // Delete data
    public function destroy($id)
    {
        $destroy = Product::find($id);
        if($destroy){
            $destroy->delete();
            return["message" => "Delete Success"];
        }else{
            return["message" => "Data not found"];
        }
    }
}
