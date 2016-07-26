<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

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

    /**
     * Bill detail belongs to a bill
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
        return $this->belongsTo('App\Models\Bill');
    }

    /**
     * Bill detail has a product
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Get total daily amount
     *
     * @return int
     */
    public static function dailyTotalAmount()
    {
        return BillDetail::where('bills_details.created_at', '>=', DB::raw("concat(CURDATE(), ' 00:00:00')"))
                         ->sum('bills_details.amount');
    }

    /**
     * Get daily percentage of categories
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getTodays()
    {
        return BillDetail::join('products', 'bills_details.product_id', '=', 'products.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('categories.id', 'categories.name', DB::raw('round(sum(bills_details.amount) / ' . BillDetail::dailyTotalAmount() . ' * 100, 2) as total'))
                        ->where('bills_details.created_at', '>=', DB::raw("concat(CURDATE(), ' 00:00:00')"))
                        ->groupBy('categories.name');
    }
}
