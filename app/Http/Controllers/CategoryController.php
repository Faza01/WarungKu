<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // show data
    public function index()
    {
        $data = Category::all();

        // return $data;
        return response()->json([
            "message" => "Load data success",
            "data" => $data
        ], 200);
    }

   // add data
    public function store(Request $request)
    {
        $store = Category::create($request->all());
        
        return response()->json([
            "message" => "Create data success",
            "data" => $store
        ], 200);
    }

    //
    public function show($id)
    {
        //
    }

    // Update Catrgory
    public function update(Request $request, $id)
    {
        $update = Category::where("id_categories", $id)->update($request->all());
        
        // return $update;
         return response()->json([
            "message" => "Update data success",
            "data" => $update
        ], 200);
    }

    // Delete Category
    public function destroy($id)
    {
        $data = Category::where("id_categories", $id);
        if($data){
            $data->delete();
            return["message" => "Delete Success"];
        }else{
            return["message" => "Data not found"];
        }
    }
}
