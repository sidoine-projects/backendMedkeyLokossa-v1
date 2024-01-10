<?php

namespace Modules\Stock\Entities;

use Modules\Acl\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $fillable = [
        'code',
        'name',
        'location',
        'user_id',
        'is_synced',
        'uuid',
    ];

    protected $casts = ['is_synced' => 'boolean'];

    protected $dates = ['deleted_at']; 

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
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function stocks() {
        return $this->hasMany(\Modules\Stock\Entities\Stock::class);
    }
}
