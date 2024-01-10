<?php

namespace Modules\Hospitalization\Entities;

use Modules\Acl\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'code',
        'name',
        'bed_capacity',
        'price',
        'description',
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
     * Bed
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function beds()
    {
        return $this->hasMany(Bed::class);
    }

    /** 
     * User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
