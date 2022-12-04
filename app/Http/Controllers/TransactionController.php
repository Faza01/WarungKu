<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    // show data
    public function index()
    {
        $data = Transaction::all();
        return response([
            'status' => 200,
            'data' => $data
        ], 200);
    }

    // Add Data
    public function store(Request $request)
    {
        $product_id = $request->product_id;
        $user_id = auth()->user()->id;
        $price = Product::where('id', $product_id)->value('price');
        $qty = $request->qty;
        $total_price = $price * $qty;

        $store = new Transaction();
        $store->product_id = $product_id;
        $store->product_name = Product::where('id', $product_id)->value('name');
        $store->user_id = $user_id;
        $store->user_name = User::where('id', $user_id)->value('name');
        $store->address = $request->address;
        $store->qty = $qty;
        $store->total_price = $total_price;
        $store->payment = $request->payment;
        $store->save();

        return response()->json([
            "message" => "Create transaction success",
            "data" => $store
        ], 200);
    }

    // show my trans
    public function show()
    {
        $user_id = auth()->user()->id;
        $user_name = User::where('id', $user_id)->value('name');

        $show = Transaction::where('user_name', $user_name)->get();
        if($show){
            return response()->json([
                "message" => "Show data Success",
                "data" => $show 
            ]);
        }else{
            return ["message" => "Data not found"];
        }
    }

    // update status
    public function update(Request $request, $id)
    {
        $update = Transaction::where("id", $id)->update($request->all());
        
        // return $update;
         return response()->json([
            "message" => "Transaction confirmation success",
            "data" => $update
        ], 200);

    }

    // update status
    public function destroy($id)
    {
        //
    }
}
