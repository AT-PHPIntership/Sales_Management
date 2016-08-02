<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
use Event;

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
        'updated_at',
    );

    /**
     * Order belongs to user.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Order belongs to Supplier.
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo('App\Models\Supplier');
    }

    /**
     * Order has many OrderDetail.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail');
    }

    /**
     * Get all today's orders
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function getTodays()
    {
        return Order::where('orders.created_at', '>=', DB::raw('concat(CURDATE(), \'' . \Config::get('common.INITAL_TIME') . '\')'))
                    ->orderBy('created_at', 'asc');
    }
    
    /**
     * Get all orders with specific year
     *
     * @param int $year determine specific year
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public static function compileMonthsData($year)
    {
        return Order::whereYear('created_at', '=', $year)
                      ->get()
                      ->groupBy(function ($item, $key) {
                          return Carbon::parse($item['created_at'])->format('m');
                      })
                      ->sortBy(function ($item, $key) {
                          return $key;
                      });
    }
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::deleting(function ($order) {
            $order->orderDetails()->delete();
        });

        Event::listen('eloquent.order.update', function ($order, $productIDArray, $amountArray) {
            collect($productIDArray)->combine($amountArray)->each(function ($amount, $productID) use ($order) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $productID,
                    'amount' => $amount,
                ]);

                $product = Product::find($productID);
                $product->remaining_amount += $amount;
                $product->save();
            });
        });
    }

    /**
     * Get all today's orders.
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
    public static function getQuarterList()
    {
        return self::selectRaw('year(created_at) as `year`, quarter(created_at) as `quarter`')
                    ->groupBy('year', 'quarter')
                    ->orderByRaw('`year` desc, `quarter` desc');
    }

    /**
     * Get total cost by quarter.
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

        return self::selectRaw('year(created_at) as `year`, quarter(created_at) as `quarter`, round((sum(total_cost) - '.$firstMonth.')/'.$firstMonth.', 2) as `index`')
                   ->groupBy('year', 'quarter')
                   ->orderByRaw('`year` desc, `quarter` desc');
    }
}
