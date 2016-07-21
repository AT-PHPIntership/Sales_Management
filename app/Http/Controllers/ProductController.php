<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Session;

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
    public function store(ProductRequest $request)
    {

        try {
             $product = $request->all();
             Product::create($product);

             return redirect()->route('product.create')->withMessage(trans('products.successfull_message'));
        } catch (Exception $saveException) {
            // Catch exceptions when data cannot save.
            return redirect()->route('product.create')->withErrors(trans('products.error_message'));
        }
    }
        
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
    public function index()
    {
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view('product.edit')->with('categories', $categories)
                                   ->with('product', $product);
    }
    /**
     * Update the form when click edit button.
     *
     * @param \Illuminate\Http\Request $request request
     * @param \Illuminate\Http\Request $id      id
     *
     * @return \Illuminate\Http\Response
     */
    public function update( $id ,Request $request)
    {
        
        $product = Product::findOrFail($id);
        $input = $request->all();

        $product->fill($input)->save();

        Session::flash('flash_message', 'Product successfully added!');

        return redirect()->route('product.index');
    }
}
