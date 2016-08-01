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
     * @return \Illuminate\Http\Response
     */
    public function monthly()
    {   
        $total_cost = Bill::whereYear('created_at', '=', 2015)
                    ->whereMonth('created_at', '=', 5)
                    ->get()
                    ->sum('total_cost');
        $data['billMonths'] = Bill::compileMonthsData(2015);
        $data['orderMonths'] = Order::compileMonthsData(2015);
        $data['staffsData'] = Bill::compileStaffContribution(2015, 5);
        $data['total_cost'] = $total_cost;
        return view('statistics.monthly')->with($data);
    }
    
    public function demoeloquent () {
      // $months = Bill::compileStaffContribution(2015, 8);
      $months = BillDetail::whereYear('created_at', '=', 2015)
                  ->whereMonth('created_at', '=', 5)
                  ->get();
      dd($months->groupBy('product_id')->each(function($value, $key) {
          return $value->count();
      }));
      foreach ($months as $month) {
          echo $month->first()->user->name ."<br>";
      }
      // echo $bill->sum('total_cost');
    }
}
