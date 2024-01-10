<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeProduct extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $fillable = [
        'name',
        'user_id',
        'is_synced',
        'uuid',
    ];

    protected $casts = ['is_synced' => 'boolean'];

    protected $dates = ['deleted_at']; 

    /**
     * Products
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
