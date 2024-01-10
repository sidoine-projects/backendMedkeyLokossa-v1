<?php

namespace Modules\Stock\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use Modules\Acl\Entities\User;

class Category extends Model
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

    //Must be uncommented once the module User is created
    /** 
     * User
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
    */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Products
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
    */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
