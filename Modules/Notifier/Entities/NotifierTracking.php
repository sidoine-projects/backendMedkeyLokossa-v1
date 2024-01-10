<?php

namespace Modules\Notifier\Entities;

use App\Models\AppModele;
use Venturecraft\Revisionable\RevisionableTrait;

class NotifierTracking extends AppModele
{
    use RevisionableTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */
    
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'uuid',
        'sujet',
        'message',
        'destinataires',
        'objet',
        'nombre_fois',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'destinataires' => 'array',
    ];
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    
    /**
     * Get the table associated with the model.
     *
     * @return string
     */
    public function getTable() {
        $pt = config('notifier.prefixe_table');
        return $pt . 'notifier_trackings';
    }
    
    public static function createDonnees($donnees){
        return NotifierTracking::create([
            'sujet' => $donnees["sujet"],
            'message' => $donnees["message"],
            'destinataires' => $donnees["destinataires"],
            'objet' => $donnees["objet"],
        ]);
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */    
        
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
   

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    
}
