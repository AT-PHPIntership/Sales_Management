<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = 'bills_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = array(
        'id',
        'bill_id',
        'product_id',
        'amount',
        'cost',
        'created_at',
        'updated_at'
    );
}
