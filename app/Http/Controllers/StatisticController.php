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
     * Daily statistics model
     *
     * @return \Illuminate\Http\Response
     */
    public function daily()
    {
        $data = [];
        $data['bills'] = Bill::where('bills.created_at', '>=', DB::raw('concat(CURDATE(), \' 00:00:00\')'))
                ->orderBy('created_at', 'asc');
                // ->get();

        $data['orders'] = Order::where('orders.created_at', '>=', DB::raw('concat(CURDATE(), \' 00:00:00\')'))
                ->orderBy('created_at', 'asc');
                // ->get();

        $data['total'] = BillDetail::where('bills_details.created_at', '>=', DB::raw('concat(CURDATE(), \' 00:00:00\')'))
                                     ->sum('bills_details.amount');

        $data['data'] = BillDetail::join('products', 'bills_details.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('categories.id',
                         'categories.name',
                         DB::raw('round(sum(bills_details.amount) / ' . $data['total'] . ' * 100, 2) as total'))
                ->where('bills_details.created_at', '>=', DB::raw('concat(CURDATE(), \' 00:00:00\')'))
                ->groupBy('categories.name')
                ->get();
                
        return view('statistics.daily')->with($data);
    }
}
