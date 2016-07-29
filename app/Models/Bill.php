<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
     * Get all order amount by quarter
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getQuartersList()
    {
        return Bill::selectRaw('year(created_at) as `year`, quarter(created_at) as `quarter`')
                    ->groupBy('year', 'quarter')
                    ->orderByRaw('`year` desc, `quarter` desc');
    }

    /**
     * Description
     *
     * @param Data type $parameter Description
     *
     * @return Return type
     */
    public static function quarterTotal($year, $quarter)
    {
        return Bill::selectRaw('year(created_at) as `year`, month(created_at) as `month`, sum(total_cost) as total')
                   ->whereRaw('QUARTER(created_at) = ' . $quarter . ' and year(created_at) = ' . $year)
                   ->groupBy('year', 'month')
                   ->orderByRaw('`year` desc, `month` asc');
    }

}
