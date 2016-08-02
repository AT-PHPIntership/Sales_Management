<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillDetail;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests;
use DB;
use Carbon\Carbon;

class StatisticController extends Controller
{
    /**
     * Daily statistics counting
     *
     * @return \Illuminate\Http\Response
     */
    public function daily(Request $request)
    {
        if (!isset($request['date-picker'])) {
            $data['date'] = date(\Config::get('common.DATE_DMY_FORMAT'), time());
        } else {
            $data['date'] = $request['date-picker'];
        }
        $date = Carbon::createFromFormat('d/m/Y', $data['date'])->toDateString();

        $data['bills'] = Bill::getByDate($date);

        $data['orders'] = Order::getByDate($date);
        $data['topTen'] = Product::getByDate($date)->paginate(\Config::get('common.SELECT_TEN'));
        $data['categories'] = BillDetail::getByDate($date)->paginate(\Config::get('common.SELECT_FIVE'));

        return view('statistics.daily')->with($data);
    }
}
