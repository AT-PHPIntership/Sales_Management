<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BillDetail;
use App\Models\Bill;
use App\Models\Order;
use App\Http\Requests;
use DB;

class StatisticController extends Controller
{
    /**
     * Daily statistics model
     *
     * @return \Illuminate\Http\Response
     */
    public function daily()
    {
        $bills = Bill::where('bills.created_at', '>=', DB::raw('concat(CURDATE(), \' 00:00:00\')'))
                ->orderBy('created_at', 'asc');
                // ->get();

        $orders = Order::where('orders.created_at', '>=', DB::raw('concat(CURDATE(), \' 00:00:00\')'))
                ->orderBy('created_at', 'asc')
                ->get();

        $data = DB::table('bills_details')
                ->join('products', 'bills_details.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->selectRaw('categories.id, categories.name, sum(bills_details.amount) as sum')
                ->where('bills_details.created_at', '>=', DB::raw('concat(CURDATE(), \' 00:00:00\')'))
                ->groupBy('categories.name')
                ->get();

        $categoiesRatio = DB::table('bills_details')

        ;

        $totalDailyAmount = 0;
        foreach ($data as $miniCategory) {
            $totalDailyAmount += $miniCategory->sum;
        }
        foreach ($data as $miniCategory) {
            $miniCategory->ratio = $miniCategory * 100 / $totalDailyAmount;
        }

        return view('statistics.daily')->with('bills', $bills)
                                       ->with('orders', $orders);
    }
}
