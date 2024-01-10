<?php

namespace Modules\Medicalservices\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Modules\Patient\Entities\Patiente;

use Modules\Administration\Entities\MedicalAct;

class LaboratoireRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'services_id',
        'movments_id',
        'act_code',
        'intrant',
        'param',
        'value',
        'ref_value',
        'unit',
        'summary',
        'operator'
    ];

protected $appends =  ['operatorname','actname'];

    protected static function newFactory()
    {
        return \Modules\Medicalservices\Database\factories\LaboratoireRecordFactory::new();
    }


  public function getActnameAttribute(){
    $Act = MedicalAct::where('code',$this->act_code)->first();
    return $Act->designation;
  }
      public function getOperatornameAttribute(){
    $Patient = Patiente::find($this->operator);
    return $Patient->lastname. " ". $Patient->firstname;
  }
}
