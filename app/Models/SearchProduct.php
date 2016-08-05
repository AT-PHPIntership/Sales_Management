<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchProduct extends Model
{
    protected $table = 'search_products';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array(
        'id',
        'product_id',
        'search_text',
        'create_at',
        'updated_at',
    );
    
    /**
     * SearchProduct has a product.
     *
     * @return Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}
