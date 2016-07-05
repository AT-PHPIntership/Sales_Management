<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
     /**
     * Product belongs to Category
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }
     /**
     * Product belongs to many BillDetail
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function bill_detail()
    {
        return $this->belongsToMany('App\Models\BillDetail', 'product_id');
    }
    /**
     * Product belongs to many OrderDetail
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */

    public function order_detail()
    {
        return $this->belongsToMany('App\Models\Order_Detail', 'product_id');
    }
}