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
        return $this->belongsTo('App\Models\Category');
    }
    /**
     * Product belongs to many BillDetail
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function billDetail()
    {
        return $this->belongsToMany('App\Models\BillDetail');
    }
    /**
     * Product belongs to many OrderDetail
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
