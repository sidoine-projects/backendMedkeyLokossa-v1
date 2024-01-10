<?php

namespace Modules\Stock\Entities;

use Modules\Acl\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockTransfer extends Model
{
    use SoftDeletes; 
    use HasFactory;

    protected $fillable = [
        'comment',
        'model_name',
        'model_id',
        'from_stock_id',
        'user_id',
        'is_synced',
        'uuid'
    ];

    protected $casts = ['is_synced' => 'boolean'];

    protected $dates = ['deleted_at']; 

    //Must be uncommented once the module User is created
    // /** 
    //  * User
    //  * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    // */
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    /**
     * Stock
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function fromStock()
    {
        return $this->belongsTo(Stock::class, 'from_stock_id');
    }

    /**
     * Stock
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function toStock()
    {
        return $this->belongsTo(Stock::class, 'model_id');
    }

    /**
     * StockTransferProduct
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function stockTransferProducts() {
        return $this->hasMany(StockTransferProduct::class);
    }
}
