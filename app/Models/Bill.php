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
        'updated_at',
    );

    /**
     * Bill belongs to user.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Bill has many BillDetail.
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

    /**
     * Scope a query to join orders and bills to get PI.
     *
     * @param string $query query string
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeJoinOrders($query)
    {
        return $query->join('orders', function ($join) {
            $join->on(DB::raw('year(orders.created_at) = year(bills.created_at)'), DB::raw(''), DB::raw(''));
            $join->on(DB::raw('QUARTER(orders.created_at) = QUARTER(bills.created_at)'), DB::raw(''), DB::raw(''));
        });
    }

    /**
     * Get all today's bills.
     *
     * @param string $date input date
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getByDate($date)
    {
        return self::whereRaw('date(created_at) = \''.$date.'\'')
                   ->orderBy('created_at', 'asc');
    }

    /**
     * Get all order amount by quarter.
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getQuartersList()
    {
        return self::selectRaw('year(created_at) as `year`, quarter(created_at) as `quarter`')
                    ->groupBy('year', 'quarter')
                    ->orderByRaw('`year` desc, `quarter` desc');
    }

    /**
     * Get total by quarter.
     *
     * @param int $year    year
     * @param int $quarter quarter
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function quarterTotal($year, $quarter)
    {
        return self::selectRaw('year(created_at) as `year`, monthname(created_at) as `month`, sum(total_cost) as total')
                   ->whereRaw('QUARTER(created_at) = '.$quarter.' and year(created_at) = '.$year)
                   ->groupBy('year', 'month')
                   ->orderByRaw('`year` desc, `month` asc');
    }

    /**
     * Get index by quarter.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getIndex()
    {
        $firstMonth = self::selectRaw('year(created_at) as `year`, quarter(created_at) as `quarter`, sum(total_cost) as sum')
                          ->groupBy('year', 'quarter')
                          ->orderByRaw('year(created_at) asc , QUARTER(created_at) asc')
                          ->first()
                          ->sum;

        return self::selectRaw('year(created_at) as `year`, quarter(created_at) as `quarter`, round((sum(total_cost) / '.$firstMonth.') - 1, 2) as `index`')
                   ->groupBy('year', 'quarter')
                   ->orderByRaw('`year` desc, `quarter` desc');
    }

    /**
     * Get Profitability Index.
     *
     * @return Return type
     */
    public static function getPI()
    {
        return self::selectRaw('year(orders.created_at) as `year`, QUARTER(orders.created_at) as `quarter`, sum(orders.total_cost) as `totalOrder`, sum(bills.total_cost) as `totalBills`, round((sum(bills.total_cost) / sum(orders.total_cost) - 1), 2) as `PI`')
                   ->joinOrders()
                   ->groupBy('year', 'quarter')
                   ->orderByRaw('`year` desc, `quarter` desc');
    }
}
