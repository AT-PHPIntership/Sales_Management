<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function bill_detail()
    {
        return $this->belongsToMany('App\Models\BillDetail', 'product_id');
    }

    public function order_detail()
    {
        return $this->belongsToMany('App\Models\Order_Detail', 'product_id');
    }
}