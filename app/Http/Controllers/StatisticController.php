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
     * @return Illuminate\Http\Response
     */
    public function quarterly(Request $request)
    {
        if(!isset($request->quarter)) {
            $quarter = date('Y') . 'Q' . StatisticController::toQuarter((date('n') -1));
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

        $data['categories'] = BillDetail::getQuarter($year, $quarter)->paginate(5);
        $data['topTen'] = Product::getQuarter($year, $quarter)->paginate(10);
        // dd($data['categories']->paginate(5));

        // dd($data['quaterlyTotalBill'], $data['quaterlyTotalOrder']);
        return view('statistics.quarterly')->with($data);
    }

    /**
     * Convert partten 'YYYYM' to 'YYYYQ'
     *
     * @param int $yearMonth year and month
     *
     * @return int
     */
    public static function toQuarter($month)
    {
        switch ($month) {
            case '1':
            case '2':
            case '3':
                return '1';
            case '4':
            case '5':
            case '6':
                return '2';
            case '7':
            case '8':
            case '9':
                return '3';
            case '10':
            case '11':
            case '12':
                return '4';
            default:
                throw new Exception('Unknow the month: ' . $month);
                break;
        }
    }

}
