<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests\ProductRequest;
use Redirect;

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
        $products = Product::all();

        return view('product.index', ['products' => $products]);
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
        try {
            $categories = Category::all();
            $product = Product::findOrFail($id);
            return view('product.edit')->with('categories', $categories)
                                       ->with('product', $product);
        } catch (ModelNotFoundException $ex) {
            return redirect()->route('product.index')->withErrors(trans('products.error_message'));
        }
    }

    /**
     * Update the form when click edit button.
     *
     * @param \Illuminate\Http\Request $request request
     * @param \Illuminate\Http\Request $id      id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        try {
            $input = $request->all();
            $product = Product::findOrFail($id);
            $product->fill($input)->save();
            return Redirect::back()->withMessage(trans('products.successfull_edit_message'));
        } catch (ModelNotFoundException $ex) {
            return Redirect::back()->withInput()->withErrors(trans('products.error_message'));
        }
    }
    /**
     * Show the application user profile
     *
     * @param integer $id determine specific user
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('product.show')->with('categories', $categories)
                                   ->with('product', $product);
    }
}
