<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransferProduct extends Model
{

    use SoftDeletes; 
    use HasFactory;

    protected $fillable = [
        'quantity_transfered',
        'stock_product_id',
        'stock_transfer_id',
        'is_synced',
        'uuid'
    ];

    protected $casts = ['is_synced' => 'boolean'];

    protected $dates = ['deleted_at']; 

    /**
     * StockProduct
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function stockProduct()
    {
        return $this->belongsTo(StockProduct::class, 'stock_product_id');
    }

    /**
     * StockTransfer
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function stockTransfer()
    {
        return $this->belongsTo(StockTransfer::class, 'stock_transfer_id');
    }

}
