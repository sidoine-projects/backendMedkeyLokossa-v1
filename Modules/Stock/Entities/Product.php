<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Acl\Entities\User;



class Product extends Model
{
    use SoftDeletes; 
    use HasFactory;

    protected $fillable = [
        'uuid',
        'code',
        'name',
        'dosage',
        'brand',
        'conditioning_unit_id',
        'administration_route_id',
        'sale_unit_id',
        'category_id',
        'user_id',
        'is_synced',
        'type_id',
    ];

    protected $casts = ['is_synced' => 'boolean'];

    protected $dates = ['deleted_at']; 

    //Must be uncommented once the module User is created
    // /** 
    //  * User
    //  * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    // */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Type
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function type()
    {
        return $this->belongsTo(TypeProduct::class);
    }

    /**
     * ConditioningUnit
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function conditioning_unit()
    {
        return $this->belongsTo(ConditioningUnit::class);
    }

    /**
     * AdministrationRoute
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function administration_route()
    {
        return $this->belongsTo(AdministrationRoute::class);
    }

    /**
     * SaleUnit
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function sale_unit()
    {
        return $this->belongsTo(SaleUnit::class);
    }

    /**
     * Category
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * SupplyProduct
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function supplyProducts()
    {
        return $this->hasMany(SupplyProduct::class);
    }

    /**
     * StockProduct
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function stockProducts()
    {
        return $this->hasMany(StockProduct::class);
    }
}
