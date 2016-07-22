<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use Exception;

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

             $errors = trans('products.delete.products.successfull_message');
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
     * Destroy the specified product from storage.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            $errors = trans('products.delete.error_message');
         try {
            $products= Product::findOrFail($id);
            $numberofOrder_details = count($products->order_details);
            $numberofBills_details = count($products->bills_details);
            if($numberofOrder_details || $numberofBills_details)
              $errors = trans('prodcuts.delete.delete_unsuccessful');

            else {
                $productName = $products->name;
                $products->delete();

                return redirect()->route('product.index')
                                 ->withMessage($productName.trans('prodcuts.delete.delete_successful'));
                }
            } catch (Exception $modelNotFound) {
        }

        return redirect()->route('product.index')->withErrors($errors);
    }
 
}
