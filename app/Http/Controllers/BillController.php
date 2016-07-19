<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Http\Requests;
use App\Models\BillDetail;
use App\Http\Requests\BillRequest;
use Auth;
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
     * @param \Illuminate\Http\BillRequest $request hold data from request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BillRequest $request)
    {
        try {
            $bill = new Bill;
            $bill->user_id = Auth::user()->id;
            $bill->description = $request->description;
            $bill->total_cost = $request->total_cost;
            $bill->created_at = new DateTime();
            $bill->updated_at = new DateTime();
            $bill->save();
            $createdBill = Bill::where('created_at', $bill->created_at)->first();
            $size = count($request->product_id);
            for ($i=0; $i < $size; $i++) {
                $billDetail = new BillDetail;
                $billDetail->bill_id = $createdBill->id;
                $billDetail->product_id = $request->product_id[$i];
                $billDetail->amount = $request->amount[$i];
                $billDetail->created_at = new DateTime();
                $billDetail->updated_at = new DateTime();
                $billDetail->save();
            }
            return redirect()->route('bill.create')
                             ->withMessage(trans('bills.create.successfull_message'));
        } catch (Exception $saveException) {
            return redirect()->route('bill.create')
                             ->withErrors(trans('bills.create.error_message'));
        }
    }
}
