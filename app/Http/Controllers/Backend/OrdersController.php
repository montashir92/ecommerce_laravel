<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrdersController extends Controller
{
    
    public function pendingList()
    {
        $orders = Order::where('status', 0)->get();;
        return view('backend.pages.orders.pending_list', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function approvedList()
    {
        $orders = Order::where('status', 1)->get();;
        return view('backend.pages.orders.approved_list', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approved(Request $request)
    {
        $order = Order::find($request->id);
        $order->status = 1;
        $order->save();
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $orders = Order::find($id);
        return view('backend.pages.orders.order_details', compact('orders'));
    }

}
