<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class SupplyProduct extends Model
{
    use HasFactory;
    use SoftDeletes; // Pour activer la fonctionnalité de soft delete


    protected $fillable = [
        'units_per_box',
        'expire_date',
        'lot_number',
        'quantity',
        'purchase_price',
        'profit_margin',
        'supply_id',
        'product_id',
        'supplier_id',
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
     * Supply
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }

    /**
     * Supplier
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
