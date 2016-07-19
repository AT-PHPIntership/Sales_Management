<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Http\Requests;
use App\Models\BillDetail;
use DateTime;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = Bill::all();
        return view('bills.index', compact('bills'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('bills.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request hold data from request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $bill = new Bill;
            $bill->user_id = $request->user_id;
            $bill->description = $request->description;
            $bill->total_cost = $request->total_cost;
            $bill->created_at = new DateTime();
            $bill->updated_at = new DateTime();
            $bill->save();
            $x = Bill::where('created_at', $bill->created_at)->first();
            $size = count($request->product_id);
            for ($i=0; $i < $size; $i++) {
              $bill_detail = new BillDetail;
              $bill_detail->bill_id = $x->id;
              $bill_detail->product_id = $request->product_id[$i];
              $bill_detail->amount = $request->amount[$i];
              $bill_detail->created_at = new DateTime();
              $bill_detail->updated_at = new DateTime();
              $bill_detail->save();
            }
            return redirect()->route('bill.create')
                             ->withMessage(trans('users.successfull_message'));
        } catch (Exception $saveException) {
            return redirect()->route('user.create')
                             ->withErrors(trans('users.error_message'));
        }
    }
}
