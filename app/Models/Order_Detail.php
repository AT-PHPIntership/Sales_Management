<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Detail extends Model
{
    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product', 'id');
    }
}
