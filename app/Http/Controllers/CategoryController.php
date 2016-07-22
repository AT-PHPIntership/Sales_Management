<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * Show the form for creating a new category.
     *
     * @return \Illuminate\Http\Responsed
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param \Illuminate\Http\Request $request request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->all();
            Category::create($data);
            return redirect()->action('CategoryController@create')
                             ->withMessage(trans('categories.create.successful_msg'));
        } catch (Exception $ex) {
            return redirect()->action('CategoryController@create')
                             ->withMessage(trans('categories.common.error_message'));
        }
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param int $id id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $category = Category::findOrFail($id);
            return view('categories.edit', [
                'category' => $category
            ]);
        } catch (ModelNotFoundException $ex) {
            return redirect()->action('CategoryController@index')
                             ->withErrors(trans('categories.common.error_message'));
        }
    }
    /**
     * Update the specified category in storage
     *
     * @param Request $request request
     * @param int     $id      id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->update();
            return redirect()->action('CategoryController@edit', [
                'category' => $category->id
            ])->withMessage(trans('categories.edit.successful_msg'));
        } catch (ModelNotFoundException $ex) {
            return redirect()->action('CategoryController@index')
                             ->withErrors(trans('categories.common.error_message'));
        }
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
            if (count($category->product) > 0) {
                $response['isSuccess'] = \Config::get('common.UNSUCCESSFUL_FLAG');
                $response['message'] = trans('categories.delete.unsuccessful_msg', [
                    'category' => $category->name
                ]);
            } else {
                $response['isSuccess'] = \Config::get('common.SUCCESSFUL_FLAG');
                $response['message'] = trans('categories.delete.successful_msg', [
                    'category' => $category->name
                ]);
                $category->delete();
            }
        } catch (ModelNotFoundException $ex) {
            $response['isSuccess'] = \Config::get('common.UNSUCCESSFUL_FLAG');
            $response['message'] = trans('categories.common.not_found');
        }
        return \Response::json($response);
    }
}
