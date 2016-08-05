<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::auth();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', ['uses' => 'BillController@create', 'as' => 'home']);
});

Route::group(['middleware' => ['auth', 'roles'], 'roles' => ['SuperAdmin']], function () {

    Route::group(['roles' => ['Manager']], function () {
        Route::get('/user/search', ['uses' => 'UserController@searchUser', 'as' => 'search.user']);

        Route::resource('category', 'CategoryController', [
            'except' => ['destroy'],
        ]);

        Route::delete('category/{category?}', 'CategoryController@destroy');

        Route::resource('product', 'ProductController');

        Route::resource('order', 'OrderController');

        Route::resource('user', 'UserController', [
            'only' => ['index', 'show'],
        ]);
    });

    Route::resource('user', 'UserController', [
        'except' => ['index', 'show'],
    ]);

    Route::group(['roles' => ['Manager', 'Staff']], function () {
        Route::resource('bill', 'BillController');

        Route::put('user/{id}/avatar', [
            'uses' => 'UserController@updateAvatar',
            'as' => 'user.updateAvatar',
        ]);

        Route::put('user/{id}/account', [
            'uses' => 'UserController@updateAccount',
            'as' => 'user.updateAccount',
        ]);

        Route::get('api/product', function () {
            return Response::json(\App\Models\Product::where('remaining_amount', '!=', 0)->where('is_on_sale', \Config::get('common.ON_SALE'))->get());
        });

        Route::get('api/order/product', function () {
            return Response::json(\App\Models\Product::all());
        });
    });

    Route::group(['prefix' => 'statistic'], function () {

        Route::get('/daily', [
            'uses' => 'StatisticController@daily',
            'as' => 'statistic.daily',
        ]);

        Route::get('/monthly', [
            'uses' => 'StatisticController@monthly',
            'as' => 'statistic.monthly',
        ]);

        Route::get('/quarterly', [
            'uses' => 'StatisticController@quarterly',
            'as' => 'statistic.quarterly',
        ]);

        Route::get('/home', ['uses' => 'BillController@create', 'as' => 'home']);
    });
});
