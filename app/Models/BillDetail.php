<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

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
        'updated_at',
    );

    /**
     * Bill detail belongs to a bill.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function bill()
    {
        return $this->belongsTo('App\Models\Bill');
    }

    /**
     * Bill detail has a product.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    /**
     * Scope a query to select only today's bill detail.
     *
     * @param string $query query string
     * @param string $date  input date
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeDaily($query, $date)
    {
        return $query->whereRaw('date(`bills_details`.`created_at`) = \''.$date.'\'');
    }

    /**
     * Scope a query to select bill details by quarterly.
     *
     * @param int $query   query string
     * @param int $year    year
     * @param int $quarter quarter
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeQuarterly($query, $year, $quarter)
    {
        return $query->whereRaw('QUARTER(bills_details.created_at) = '.$quarter.' and year(bills_details.created_at) = '.$year);
    }

    /**
     * Get total daily amount.
     *
     * @param string $date input date
     *
     * @return int
     */
    public static function dailyTotalAmount($date)
    {
        return self::daily($date)->sum('bills_details.amount');
    }

    /**
     * Get daily percentage of categories.
     *
     * @param string $date input date
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getByDate($date)
    {
        return self::join('products', 'bills_details.product_id', '=', 'products.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('categories.id', 'categories.name', DB::raw('round(sum(bills_details.amount) / '.self::dailyTotalAmount($date).' * '.self::PERCENT.', 2) as percentage'))
                        ->daily($date)
                        ->groupBy('categories.name');
    }

    /**
     * Get total amount by quarter.
     *
     * @param int $year    year
     * @param int $quarter quarter
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function quarterTotalAmount($year, $quarter)
    {
        return self::quarterly($year, $quarter)->sum('bills_details.amount');
    }

    /**
     * Get total by quarter.
     *
     * @param int $year    year
     * @param int $quarter quarter
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getQuarter($year, $quarter)
    {
        return self::join('products', 'bills_details.product_id', '=', 'products.id')
                        ->join('categories', 'products.category_id', '=', 'categories.id')
                        ->select('categories.id', 'categories.name', DB::raw('round(sum(bills_details.amount) / '.self::quarterTotalAmount($year, $quarter).' * '.self::PERCENT.', 2) as percentage'))
                        ->quarterly($year, $quarter)
                        ->groupBy('categories.name')
                        ->orderBy('percentage', 'desc');
    }
}
