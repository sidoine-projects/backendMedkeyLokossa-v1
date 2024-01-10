<?php

namespace Modules\Medicalservices\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Modules\Patient\Entities\Patiente;

use Modules\Administration\Entities\MedicalAct;

class ChirurgieRecord extends Model
{
  use HasFactory;

  protected $fillable = [
    'uuid',
    'services_id',
    'movments_id',
    'act_code',
    'reason',
    'description',
    'result',
    'summary',
    'operator',
    'status'
  ];

  protected $appends =  ['operatorname','actname'];

  public function getOperatornameAttribute(){
    $Patient = Patiente::find($this->operator);
    return $Patient->lastname. " ". $Patient->firstname;
  }

  public function getActnameAttribute(){
    $Act = MedicalAct::where('code',$this->act_code)->first();
    return $Act->designation;
  }

  protected static function newFactory()
  {
    return \Modules\Medicalservices\Database\factories\ChirurgieRecordFactory::new();
  }
}
