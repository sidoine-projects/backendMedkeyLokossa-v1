<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class SaleProduct extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $fillable = [
        'price',
        'quantity',
        'sale_id',
        'stock_products_id',
        'user_id',
        'is_synced',
        'uuid'
    ];

    protected $casts = ['is_synced' => 'boolean'];

    protected $dates = ['deleted_at']; 

    //Must be uncommented once the module User and Movement are created
    // /** 
    //  * User
    //  * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    // */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /** 
     * Sale
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    /** 
     * StockProduct
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function stockProduct()
    {
        return $this->belongsTo(StockProduct::class);
    }
}
