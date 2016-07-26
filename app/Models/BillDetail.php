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
    public function scopeDaily($query)
    {
        return $query->where('bills_details.created_at', '>=', DB::raw("concat(CURDATE(), '" . \Config::get('common.INITAL_TIME') . "')"));
    }


    /**
     * Get total daily amount
     *
     * @return int
     */
    public static function dailyTotalAmount()
    {
        return BillDetail::daily()->sum('bills_details.amount');
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
                        ->select('categories.id', 'categories.name', DB::raw('round(sum(bills_details.amount) / ' . BillDetail::dailyTotalAmount() . ' * ' . BillDetail::PERCENT . ') as percentage'))
                        ->daily()
                        ->groupBy('categories.name');
    }
}
