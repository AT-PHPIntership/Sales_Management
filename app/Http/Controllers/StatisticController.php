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
        $currentDate = DB::raw('concat(CURDATE(), \' 00:00:00\')');

        $data['total'] = BillDetail::where('bills_details.created_at', '>=', $currentDate)
                                     ->sum('bills_details.amount');

        $dailyData = BillDetail::join('products', 'bills_details.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('categories.id',
                         'categories.name',
                         DB::raw('round(sum(bills_details.amount) / ' . $data['total'] . ' * 100, 2) as total'))
                ->where('bills_details.created_at', '>=', $currentDate);

        $data['bills'] = Bill::where('bills.created_at', '>=', $currentDate)
                ->orderBy('created_at', 'asc');

        $data['orders'] = Order::where('orders.created_at', '>=', $currentDate)
                ->orderBy('created_at', 'asc');

        $data['categories'] = BillDetail::join('products', 'bills_details.product_id', '=', 'products.id')
                ->join('categories', 'products.category_id', '=', 'categories.id')
                ->select('categories.id',
                         'categories.name',
                         DB::raw('round(sum(bills_details.amount) / ' . $data['total'] . ' * 100, 2) as total'))
                ->where('bills_details.created_at', '>=', $currentDate)
                ->groupBy('categories.name');

        $data['topTen'] = Product::join('bills_details', 'bills_details.product_id', '=', 'products.id')
                                   ->select('products.id',
                                            'products.name',
                                            DB::raw('sum(bills_details.amount) as total'))
                                   ->where('bills_details.created_at', '>=', $currentDate)
                                   ->groupBy('products.id')
                                   ->orderBy('total', 'desc');

        // dd($data['topTen']->paginate(10)->toArray());

        return view('statistics.daily')->with($data);
    }
}
