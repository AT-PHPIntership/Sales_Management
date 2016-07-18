<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests;

class StatisticController extends Controller
{
    /**
     * Daily statistics model
     *
     * @return \Illuminate\Http\Response
     */
    public function daily ()
    {
        $products = Product::get();
        return view('statistics.daily')->with('products', $products);
    }

}
