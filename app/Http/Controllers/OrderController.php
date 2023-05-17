<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Subcategory;
use App\Models\User;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Order::all();
        return view('orders.index',compact('data'));
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
    public function store($subcategory, $user, $store)
    {
        foreach ($subcategory as $subcategory)
            $subcategory_id = $subcategory->id;
        foreach ($user as $user)
            $user_id = $user->id;
        //foreach ($stores as $store)
            $store_id = $store->id;

        $data = ["subcategory_id" => $subcategory_id, "user_id" => $user_id];
        Order::create($data);
        //$last_order = Order::latest()->get();
        $last_order = DB::table('orders')->latest()->first();
        //foreach ($last_order as $last_order)
            $last_order_id = $last_order->id;
        $store_order = ["order_id" => $last_order_id, "store_id" => $store_id];
        app('App\Http\Controllers\Store_orderController')->store($store_order);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $subcategory = Subcategory::findOrFail($order->subcategory_id);
        $user = User::findOrFail($order->user_id);
        return view('orders.show',compact('order', 'user', 'subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
        Order::findOrFail($id)->delete();
        return redirect()->route('orders.index')
                        ->with('success','Order deleted successfully');
    }


    /**
    * .
    */
    public function send($id)
    {
        $userId = Auth::id();

        $subcategory = Subcategory::where('id', $id)->get(['name']);
        $user = User::where('id', $userId)->get(['name', 'email']);
        $stores = Store::where('status', '1')->get(['email']);
        
        return view('email-template',compact('subcategory', 'user', 'stores'));
    }

}
