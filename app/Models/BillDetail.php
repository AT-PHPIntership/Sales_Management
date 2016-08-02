<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Carbon\Carbon;

class BillDetail extends Model
{
    protected $table = 'bills_details';
    const PERCENT = 100;

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
     * Scope a query to select only today's bill detail
     *
     * @param string $query query string
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDaily($query, $type)
    {
        return $query->whereRaw('date(`bills_details`.`created_at`) = \'' . $type . '\'');
    }


    /**
     * Get total daily amount
     *
     * @return int
     */
    public static function dailyTotalAmount($date)
    {
        return BillDetail::daily($date)->sum('bills_details.amount');
    }

    /**
     * Get daily percentage of categories
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByDate($date)
    {
        return BillDetail::join('products', 'bills_details.product_id', '=', 'products.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('categories.id', 'categories.name', DB::raw('round(sum(bills_details.amount) / ' . BillDetail::dailyTotalAmount($date) . ' * ' . BillDetail::PERCENT . ', 2) as percentage'))
                        ->daily($date)
                        ->groupBy('categories.name');
    }
}
