<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    /*
     * Order_Detail belongs to Order
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    /*
     * Order_Detail has many Product
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product()
    {
        return $this->hasMany('App\Models\Product', 'id');
    }
}
