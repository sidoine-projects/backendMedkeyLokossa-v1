<?php

namespace Modules\Medicalservices\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Modules\Patient\Entities\Patiente;

use Modules\Administration\Entities\MedicalAct;

class ImagerieRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'services_id',
        'movments_id',
        'act_code',
        'reason',
        'pictures',
        'result',
        'summary',
        'operator',
        'status'
    ];
    
    protected static function newFactory()
    {
        return \Modules\Medicalservices\Database\factories\ImagerieRecordFactory::new();
    }


    protected $appends =  ['operatorname','actname'];

    public function getOperatornameAttribute(){
        $Patient = Patiente::find($this->operator);
        if($Patient){
            return $Patient->lastname. " ". $Patient->firstname;
        }else{
            return "";
        }
    }

    public function getActnameAttribute(){
        $Act = MedicalAct::where('code',$this->act_code)->first();
        if($Act){
           return $Act->designation;
       }else{
        return "";
    }

}
}
