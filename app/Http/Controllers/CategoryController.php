<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the category.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        //dd($categories);
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Destroy the specified category from storage.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);
            if ($category->product) {
                $response['success'] = \Config::get('common.UNSUCCESSFUL_FLAG');
                $response['message'] = trans('categories.delete.unsuccessful_msg', [
                    'category' => $category->name
                ]);
            } else {
                $response['success'] = \Config::get('common.SUCCESSFUL_FLAG');
                $response['message'] = trans('categories.delete.successful_msg', [
                    'category' => $category->name
                ]);
            }
        } catch (ModelNotFoundException $ex) {
            $response['success'] = \Config::get('common.UNSUCCESSFUL_FLAG');
            $response['message'] = trans('categories.common.not_found');
        }
        return \Response::json($response);
    }
}
