<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = array(
        'id',
        'category_id',
        'name',
        'description',
        'price',
        'remaining_amount',
        'is_on_sale',
        'create_at',
        'updated_at',
    );

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
     * Product has many BillDetail
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billDetail()
    {
        return $this->hasMany('App\Models\BillDetail');
    }
    /**
     * Product has many OrderDetail
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }
}
