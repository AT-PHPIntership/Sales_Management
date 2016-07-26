<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
