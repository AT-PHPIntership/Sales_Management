<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillDetail;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Product;
use App\Http\Requests;
use DB;
use Exception;

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
     * @param Illuminate\Http\Request $request request
     *
     * @return Illuminate\Http\Response
     */
    public function quarterly(Request $request)
    {
        if (!isset($request->quarter)) {
            $quarter = date('Y') . 'Q' . (StatisticController::toQuarter(date('n')) - 1);
        } else {
            $quarter = $request->quarter;
        }
        $elements = explode('Q', $quarter);
        $year = $elements[0];
        $quarter = $elements[1];

        $data = [];
        $data['quatersList'] = Order::getQuarterList()->get();

        $data['quaterlyTotalBill'] = Bill::quarterTotal($year, $quarter)->get();
        $data['quaterlyTotalOrder'] = Order::quarterTotal($year, $quarter)->get();

        $data['categories'] = BillDetail::getQuarter($year, $quarter)->paginate(\Config::get('common.SELECT_FIVE'));
        $data['topTen'] = Product::getQuarter($year, $quarter)->paginate(\Config::get('common.SELECT_TEN'));

        $data['billIndex'] = Bill::getIndex()->get();
        $data['orderIndex'] = Order::getIndex()->get();

        $data['pi'] = Bill::getPI()->get();

        $data['year'] = $year;
        $data['quarter'] = $quarter;
        return view('statistics.quarterly')->with($data);
    }

    /**
     * Return quarter form month
     *
     * @param int $month month of year
     *
     * @return int
     */
    public static function toQuarter($month)
    {
        $quarter = [1, 2, 3, 4];
        if ($month < 1 || $month > 12) {
            throw new Exception('Unknow the month: ' . $month);
        }

        return $quarter[intval($month / 3)];
    }

    /**
     * Calculate the index
     *
     * @return Return type
     */
    public function calcIndex()
    {
    }
}
