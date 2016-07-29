<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
     * Get all order amount by quarter
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getQuarterList()
    {
        return Order::selectRaw('year(created_at) as `year`, quarter(created_at) as `quarter`')
                    ->groupBy('year', 'quarter')
                    ->orderByRaw('`year` desc, `quarter` desc');
    }

    /**
     * Description
     *
     * @param Data type $parameter Description
     *
     * @return Return type
     */
    public static function quarterTotal($year, $quarter)
    {
        return Order::selectRaw('year(created_at) as `year`, month(created_at) as `month`, sum(total_cost) as total')
                   ->whereRaw('QUARTER(created_at) = ' . $quarter . ' and year(created_at) = ' . $year)
                   ->groupBy('year', 'month')
                   ->orderByRaw('`year` desc, `month` asc');
    }
}
