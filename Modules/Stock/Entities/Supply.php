<?php

namespace Modules\Stock\Entities;

use Modules\Acl\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supply extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'numero',
        'total',
        'stock_id',
        'user_id',
        'is_synced',
        'uuid'
    ];

    protected $casts = ['is_synced' => 'boolean'];

    protected $dates = ['date','deleted_at']; 

    /**
     * SupplyProduct
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function supplyProducts() {
        return $this->hasMany(SupplyProduct::class);
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
     * User
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
