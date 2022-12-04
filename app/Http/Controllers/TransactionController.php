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
        $data = Transaction::where('id', auth()->user()->id)->get();
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
