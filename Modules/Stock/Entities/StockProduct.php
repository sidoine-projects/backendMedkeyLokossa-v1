<?php

namespace Modules\Stock\Entities;

use Modules\Acl\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockProduct extends Model
{
    use HasFactory;
    use SoftDeletes; // Pour activer la fonctionnalité de soft delete


    protected $fillable = [
        'lot_number',
        'units_per_box',
        'expire_date',
        'quantity',
        'purchase_price',
        'selling_price',
        'product_id',
        'stock_id',
        'user_id',
        'is_synced',
        'uuid'
    ];

    protected $casts = ['is_synced' => 'boolean'];

    protected $dates = ['expire_date','deleted_at']; 

    
    /**
     * Product
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Stock
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }

    /**
     * StockTransferProduct
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function stockTransferProducts() {
        return $this->hasMany(StockTransferProduct::class);
    }

    /**
     * SaleProduct
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function saleProducts() {
        return $this->hasMany(SaleProduct::class);
    }
}
