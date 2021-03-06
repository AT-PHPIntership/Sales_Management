<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

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
     * Product belongs to Category.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    
    /**
     * Product has many BillDetail.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billDetail()
    {
        return $this->hasMany('App\Models\BillDetail');
    }

    /**
     * Product has many OrderDetail.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetail()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    /**
     * Get all today's products.
     *
     * @param string $date input date
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getByDate($date)
    {
        return self::join('bills_details', 'bills_details.product_id', '=', 'products.id')
                      ->select('products.id', 'products.name', DB::raw('sum(bills_details.amount) as total'))
                      ->whereRaw('date(`bills_details`.`created_at`) = \''.$date.'\'')
                      ->groupBy('products.id')
                      ->orderBy('total', 'desc');
    }

    /**
     * Get all products of.
     *
     * @param int $year    year
     * @param int $quarter quarter
     *
     * @return Return type
     */
    public static function getQuarter($year, $quarter)
    {
        return self::join('bills_details', 'bills_details.product_id', '=', 'products.id')
                      ->select('products.id', 'products.name', DB::raw('sum(bills_details.amount) as total'))
                      ->whereRaw('QUARTER(bills_details.created_at) = '.$quarter.' and year(bills_details.created_at) = '.$year)
                      ->groupBy('products.id')
                      ->orderBy('total', 'desc');
    }
    
    /**
     * Get top hot 5 products monthly
     *
     * @param int $year  determine specific year
     * @param int $month determine specific month
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getTopHotProducts($year, $month)
    {
        return BillDetail::whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->get()
                    ->groupBy('product_id')
                    ->sortByDesc(function ($value) {
                        return $value->sum('amount');
                    });
    }
}
