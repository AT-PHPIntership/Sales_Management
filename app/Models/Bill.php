<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BillDetail;
use DateTime;

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
     * Process bill orders
     *
     * @var Illuminate\Http\Request $request
     *
     * @return 
     */
    public function processBillOrder($request)
    {
        $this->user_id = $request->user_id;
        $this->description = $request->description;
        $this->total_cost = $request->total_cost;
        $this->created_at = new DateTime();
        $this->updated_at = new DateTime();
        $this->save();
        $x = $this::where('created_at', $this->created_at)->first();
        $size = count($request->product_id);
        for ($i=0; $i < $size; $i++) { 
          $bill_detail = new BillDetail();
          $bill_detail->bill_id = $x->id;
          $bill_detail->product_id = $request->product_id[$i];
          $bill_detail->amount = $request->number[$i];
          $bill_detail->created_at = new DateTime();
          $bill_detail->updated_at = new DateTime();
          $bill_detail->save();
        }
    }
}
