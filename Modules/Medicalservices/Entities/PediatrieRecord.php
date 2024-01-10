<?php

namespace Modules\Medicalservices\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Modules\Patient\Entities\Patiente;

class PediatrieRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'services_id',
        'movments_id',
        'reason',
        'complaint',
        'actions',
        'observation',
        'summary',
        'operator'
    ];


    protected $appends =  ['operatorname'];
    
    protected static function newFactory()
    {
        return \Modules\Medicalservices\Database\factories\PediatrieRecordFactory::new();
    }

    public function getOperatornameAttribute(){
    $Patient = Patiente::find($this->operator);
    return $Patient->lastname. " ". $Patient->firstname;
  }
}
