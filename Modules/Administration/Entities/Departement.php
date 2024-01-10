<?php

namespace Modules\Administration\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class departement extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'nom',
    //     'pays_id',

    // ];
    protected $guarded = [];
    // Relation avec le modèle "Pays" (en supposant que vous avez un modèle "Pays" associé à la table "pays")
    public function pays()
    {
        return $this->belongsTo(Pays::class, 'pays_id');
    }
    protected static function newFactory()
    {
        return \Modules\Administration\Database\factories\DepartementFactory::new();
    }
}
