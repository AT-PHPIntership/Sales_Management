<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;
use App\Models\Order;

class OrderController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param int $id order id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = Order::findOrFail($id);
            $orderDetails = $order->orderDetails;
            return view('orders.show', [
                'order' => $order,
                'orderDetails' => $orderDetails
            ]);
        } catch (ModelNotFoundException $ex) {
            return redirect()->action('OrderController@index')
                             ->withErrors(trans('orders.common.error_message'));
        }
    }

    /**
     * Display a list of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('orders.index')->with('orders', $orders);
    }
}
