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
     * Description
     *
     * @param Data type $parameter Description
     *
     * @return Return type
     */
    public static function getQuarterList()
    {
        return Order::selectRaw('year(created_at) as `Year`, QUARTER(created_at) as `Quarter`')
                    ->groupBy('Year', 'Quarter')
                    ->orderByRaw('`year` desc, `QUARTER` desc')
                    ->get();
    }

}
