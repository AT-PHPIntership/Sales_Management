<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Requests;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Supplier;
use Auth;

class OrderController extends Controller
{
    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Responsed
     */
    public function create()
    {
        $suppliers = Supplier::all();
        return view('orders.create', [
            'suppliers' => $suppliers
        ]);
    }

    /**
     * Store a newly created order in storage.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        try {
            $totalProduct = count($request->product_id);

            $products = array();
            for ($i = 0; $i < $totalProduct; $i++) {
                $products[$i] = Product::findOrFail($request->product_id[$i]);
            }

            $order = new Order($request->all());
            $order->user_id = Auth::user()->id;
            $order->save();

            for ($i = 0; $i < $totalProduct; $i++) {
                $orderDetail = new OrderDetail;
                $orderDetail->order_id = $order->id;
                $orderDetail->product_id = $products[$i]->id;
                $orderDetail->amount = $request->amount[$i];
                $orderDetail->save();

                $products[$i]->remaining_amount += $orderDetail->amount;
                $products[$i]->save();
            }
            return redirect()->action('OrderController@show', [
                'order' => $order->id
            ])->withMessage(trans('orders.create.successful_msg'));
        } catch (ModelNotFoundException $ex) {
            return redirect()->action('OrderController@create')
                             ->withErrors(trans('orders.common.error_message'));
        }
    }

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
}
