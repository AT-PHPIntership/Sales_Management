<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Order belongs to user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Order belongs to Supplier
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }

    /**
     * Order has many Order_Detail
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_details()
    {
        return $this->hasMany('App\Models\Order_Detail', 'id');
    }
}
