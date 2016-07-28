<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillDetail;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests;
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
     * Quarterly statistics counting
     *
     * @return Illuminate\Http\Response
     */
    public function quarterly()
    {
        $data = [];
        $data['quarterList'] = Order::getQuarterList();
        return view('statistics.quarterly')->with($data);
    }
}
