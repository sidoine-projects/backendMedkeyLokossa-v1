<?php

namespace Modules\Stock\Entities;

use Modules\Acl\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stock extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $fillable = [
        'name',
        'store_id',
        'for_pharmacy_sale',
        'user_id',
        'is_synced',
        'uuid',
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
     * StockProduct
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function stockProducts()
    {
        return $this->hasMany(StockProduct::class);
    }

    /**
     * StockTransfer
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function stockTransfers()
    {
        return $this->hasMany(StockTransfer::class);
    }

    /**
     * Supply
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function supplies()
    {
        return $this->hasMany(Supply::class);
    }

    /**
     * Store
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
