<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier', 'supplier_id');
    }

    public function order_details()
    {
        return $this->hasMany('App\Models\User', 'id');
    }
}
