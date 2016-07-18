<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Requestsiuse App\Repositories\ProductRepository as Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
//use Request;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }
    /**
     * Create a new product instance.
     *
     * @param Request $request request
     *
     * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
   
        $product = new Product;
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->remaining_amount = $request->remaining_amount;
        $product->is_on_sale = $request->is_on_sale;
        $product->category_id  = $request->category;
        $product->save();
   
        return redirect()->route('product.create');
    }
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
    public function index()
    {
    }
}
