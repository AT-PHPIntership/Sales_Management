<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class Bill extends Model
{
    protected $table = 'bills';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = array(
        'id',
        'user_id',
        'description',
        'total_cost',
        'created_at',
        'updated_at'
    );

    /**
     * Bill belongs to user
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Bill has many BillDetail
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billDetails()
    {
        return $this->hasMany('App\Models\BillDetail');
    }

    /**
     * Get all today's bills
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getTodays()
    {
        return Bill::where('bills.created_at', '>=', DB::raw('concat(CURDATE(), \'' . \Config::get('common.INITAL_TIME') . '\')'))
                   ->orderBy('created_at', 'asc');
    }
    
    /**
     * Get all bills with specific year
     *
     * @param int $year determine specific year
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function compileMonthsData($year)
    {
        return Bill::whereYear('created_at', '=', $year)
                    ->get()
                    ->groupBy(function ($item, $key) {
                        return Carbon::parse($item['created_at'])->format('m');
                    })
                    ->sortBy(function ($item, $key) {
                        return $key;
                    });
    }
    
    /**
     * Get all bills with specific year
     *
     * @param int $year  determine specific year
     * @param int $month determine specific month
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function compileStaffContribution($year, $month)
    {
        return Bill::whereYear('created_at', '=', $year)
                    ->whereMonth('created_at', '=', $month)
                    ->get()
                    ->groupBy('user_id')
                    ->sortByDesc(function ($item) {
                        return $item->sum('total_cost');
                    })
                    ->take(\Config::get('common.TOP_4'));
    }
    
     /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($bill) {
            $bill->billDetails()->delete();
        });
    }
}
