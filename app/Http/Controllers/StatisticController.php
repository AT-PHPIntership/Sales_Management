<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillDetail;
use App\Models\Bill;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Exception;

class StatisticController extends Controller
{
    /**
     * Get statistics counting by date.
     *
     * @param Illuminate\Http\Request $request request
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

    /**
     * Quarterly statistics counting.
     *
     * @param Illuminate\Http\Request $request request
     *
     * @return Illuminate\Http\Response
     */
    public function quarterly(Request $request)
    {
        if (!isset($request->quarter)) {
            $quarter = date('Y').'Q'.(self::toQuarter(date('n')) - 1);
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
     * Return quarter form month.
     *
     * @param int $month month of year
     *
     * @return int
     */
    public static function toQuarter($month)
    {
        $quarter = [1, 2, 3, 4];
        if ($month < 1 || $month > 12) {
            throw new Exception('Unknow the month: '.$month);
        }

        return $quarter[intval($month / 3)];
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
