<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('order.index', [
            'orders' => Order::orderBy('created_at', 'ASC')->where('user_id', $request->user()->id)->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Order $order)
    {
        return view('order.show', [
            'orders' => Order::orderBy('created_at', 'ASC')->paginate(20)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('order.edit', [
            'order' => $order
        ]);    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
        "status" => "required",
        'payment_status' => "required",
        'address_1' => "nullable",
        'address_2' => "nullable",
        'city' => "nullable",
        'postcode' => "nullable",
        'county' => "nullable",
        'phone'  => "nullable",
        'mobile' => "nullable",
        'discount' => "nullable",
        'total' => "required",
        ]);

        $order->update($validated);

          //setting success message for the session
          session()->flash('success', 'Order details have been updated successfully');



          // redirect to order page
          return redirect()->route('orders.show', $order->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
         // delete order
         $order->delete();

         // set the success message to the session
         session()->flash('success', 'Order deleted successfully');

         // redirect to order page
         return redirect()->route('orders.index');
    }
}
