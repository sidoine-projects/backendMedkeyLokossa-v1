<?php

namespace Modules\Stock\Entities;

use Modules\Acl\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'email',
        'dial_code',
        'phone_number',
        'address',
        'profit_margin',
        'user_id',
        'is_synced',
        'uuid',
    ];

    protected $casts = [
        'is_synced' => 'boolean'
    ];

    protected $dates = [
        'deleted_at'
    ];

    /** 
     * User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * SupplyProducts
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function supplyProducts()
    {
        return $this->hasMany(SupplyProduct::class);
    }
}
