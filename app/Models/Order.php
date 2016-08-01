<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Order extends Model
{
    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = array(
        'id',
        'user_id',
        'description',
        'supplier_id',
        'total_cost',
        'created_at',
        'updated_at'
    );

    /**
     * Order belongs to user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Order belongs to Supplier
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    /**
     * Order has many OrderDetail
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    /**
     * Get all today's orders
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getTodays()
    {
        return Order::where('orders.created_at', '>=', DB::raw('concat(CURDATE(), \'' . \Config::get('common.INITAL_TIME') . '\')'))
                    ->orderBy('created_at', 'asc');
    }
    
    /**
     * Get all orders with specific year
     *
     * @param int $year determine specific year
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function compileMonthsData($year)
    {   
        return Order::whereYear('created_at', '=', $year)
                      ->get()
                      ->groupBy(function($item, $key) {
                          return Carbon::parse($item['created_at'])->format('m');
                      })
                      ->sortBy(function($collection, $key) {
                          return $key;
                      });
    }
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($order) {
            $order->orderDetails()->delete();
        });
    }
}
