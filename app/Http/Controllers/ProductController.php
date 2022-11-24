<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // show data
    public function index()
    {
        $data = Product::all();

        // return $data;
        return response()->json([
            "message" => "Load data success",
            "data" => $data
        ], 200);
    }

   // add data
    public function store(Request $request)
    {
        $store = new Product();
        $store->product_name = $request->product_name;
        $store->id_category = $request->id_category;
        $store->category = $request->category;
        $store->description = $request->description;
        $store->price = $request->price;
        $store->stock = $request->stock;
        $store->picture = $request->picture;
        $store->save();

        return response()->json([
            "message" => "Create data success",
            "data" => $store
        ], 200);
       
    }

    // show by category
    public function show($category)
    {
        $show = Product::where('category', 'like', '%' . $category . '%')->get();
        if($show){
            return response()->json([
                "message" => "Show data Success",
                "data" => $show 
            ]);
        }else{
            return ["message" => "Data not found"];
        }
    }

    // update product
    public function update(Request $request, $id)
    {
        $update = Product::where("id_product", $id)->update($request->all());
        
        // return $update;
         return response()->json([
            "message" => "Update data success",
            "data" => $update
        ], 200);
    }

    // Category
    public function destroy($id)
    {
        $data = Product::where("id_product", $id);
        if($data){
            $data->delete();
            return["message" => "Delete Success"];
        }else{
            return["message" => "Data not found"];
        }
    }
}
