<?php

namespace Modules\Stock\Entities;

use Modules\Acl\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Destock  extends Model
{
    use HasFactory;
    use SoftDeletes; 

    protected $fillable = [
        'reference_facture',
        'quantity_retrieved',
        'quantity_ordered',
        'stock_product_id',
        'user_id',
        'is_synced',
        'type_id',
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
     * StockProduct relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stockProduct()
    {
        return $this->belongsTo(StockProduct::class, 'stock_product_id');
    }

}
