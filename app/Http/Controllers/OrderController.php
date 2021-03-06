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
use Event;

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
        $order = new Order($request->all());
        $order->user_id = Auth::user()->id;
        $order->save();

        $orderID = $order->id;
        collect($request->product_id)->combine($request->amount)->each(function ($amount, $productID) use ($orderID) {
            OrderDetail::create([
                'order_id' => $orderID,
                'product_id' => $productID,
                'amount' => $amount
            ]);

            $product = Product::find($productID);
            $product->remaining_amount += $amount;
            $product->save();
        });

        return redirect()->action('OrderController@show', [
            'order' => $orderID
        ])->withMessage(trans('orders.create.successful_msg'));
    }

    /**
     * Show the application edit form
     *
     * @param integer $id determine specific order
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $order = Order::findOrFail($id);
            $orderDetails = $order->orderDetails;
            $suppliers = Supplier::all();
            return view('orders.edit', [
                'order' => $order,
                'orderDetails' => $orderDetails,
                'suppliers' => $suppliers
            ]);
        } catch (ModelNotFoundException $ex) {
            return redirect()->action('OrderController@index')
                             ->withErrors(trans('order.common.error_message'));
        }
    }

    /**
     * Update order infomation
     *
     * @param Request $request hold all data from request
     * @param integer $id      determine specific order
     *
     * @return \Illuminate\Http\Response
     */
    public function update(OrderRequest $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update($request->all());
            Event::fire('eloquent.order.update', [
                $order,
                $request->product_id,
                $request->amount
            ]);
            return redirect()->action('OrderController@show', [
                'order' => $id
            ])->withMessage(trans('orders.edit.successful_msg'));
        } catch (ModelNotFoundException $ex) {
            return redirect()->action('OrderController@edit', ['order' => $id])
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
     * Destroy the specified account from database.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->delete();
            return redirect()->route('order.index')
                             ->withMessage(trans('orders.delete.delete_successful'));
        } catch (Exception $modelNotFound) {
            return redirect()->route('order.index')->withErrors(trans('orders.error_message'));
        }
    }
}
