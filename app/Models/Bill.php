<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
