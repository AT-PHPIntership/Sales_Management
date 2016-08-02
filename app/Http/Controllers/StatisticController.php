<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillDetail;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests;
use Carbon\Carbon;
use DB;

class StatisticController extends Controller
{
    /**
     * Daily statistics counting
     *
     * @return \Illuminate\Http\Response
     */
    public function daily()
    {
        $data['bills'] = Bill::getTodays();
        $data['orders'] = Order::getTodays();
        $data['topTen'] = Product::getTodays();
        $data['categories'] = BillDetail::getTodays();

        return view('statistics.daily')->with($data);
    }
    
    /**
     * Daily statistics
     *
     * @param \Illuminate\Http\Request $request hold data from request
     *
     * @return \Illuminate\Http\Response
     */
    public function monthly(Request $request)
    {
        $year = Carbon::now()->year;
        $month = Carbon::now()->month-1;
        if (isset($request->date_picker)) {
            $month = explode("/", $request->date_picker)[0];
            $year = explode("/", $request->date_picker)[1];
        } else {
        }
        $totalCost = Bill::whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->get()
                    ->sum('total_cost');
        $data['billMonths'] = Bill::compileMonthsData($year);
        $data['orderMonths'] = Order::compileMonthsData($year);
        $data['staffsData'] = Bill::compileStaffContribution($year, $month);
        $data['totalCost'] = $totalCost;
        $data['topProducts'] = Product::getTopHotProducts($year, $month);
        $data['month'] = $month;
        $data['year'] = $year;
        return view('statistics.monthly')->with($data);
    }
}
