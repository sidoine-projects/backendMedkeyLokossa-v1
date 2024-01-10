<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $fillable = [
        'status',
        'total',
        'movement_id',
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

    // /**
    //  * Movment
    //  * @return \Illuminate\Database\Eloquent\Relations\hasMany
    // */
    // public function movement()
    // {
    //     return $this->belongsTo(Movment::class);
    // }
}
