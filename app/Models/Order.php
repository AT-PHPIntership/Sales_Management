<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
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
        return Order::where('orders.created_at', '>=', DB::raw("concat(CURDATE(), ' 00:00:00')"))
                    ->orderBy('created_at', 'asc');
    }
}
