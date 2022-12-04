<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        $category_id = $request->category_id;
        $picture = Str::random(32).".".$request->picture->getClientOriginalExtension();

        $store = new Product();
        $store->name =  $request->name;
        $store->category_id = $request->category_id;
        $store->category = Category::where('id', $category_id)->value('name');
        $store->description = $request->description;
        $store->price = $request->price;
        $store->stock = $request->stock;
        $store->picture = $picture;
        $store->save();
        
        // save image on public
        Storage::disk('public')->put($picture, file_get_contents($request->picture));

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
        $update = Product::where("id", $id)->update($request->all());
        
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
