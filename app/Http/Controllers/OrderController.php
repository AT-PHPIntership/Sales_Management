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
        /**
     * Destroy the specified category from storage.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // dd("aaaa");
        $errors = trans('orders.common.error_message');

        try {
            $order = Order::findOrFail($id);
            $numberOfOrders = count($order->orderDetails);
            
            if ($numberOfOrders) {
                $errors = trans('orders.delete.unsuccessful_msg');
            } else {
                $orderID = $order->id;
                $order->delete();
                return redirect()->route('order.index')
                                 ->withMessage($orderID.'  '.trans('orders.delete.successful_msg'));
            }
        } catch (Exception $modelNotFound) {
            return redirect()->route('orders.index')->withErrors(trans('orders.common.error_message'));
        }
        return redirect()->route('order.index')->withErrors($errors);
    }
}
