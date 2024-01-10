<?php

namespace Modules\Medicalservices\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


use Modules\Patient\Entities\Patiente;

class ConsultationRecord extends Model
{
    use HasFactory;

    protected $table = 'consultation_records';

    protected $appends =  ['operatorname'];
    
    protected static function newFactory()
    {
        return \Modules\Medicalservices\Database\factories\ConsultationRecordFactory::new();
    }



    public function getOperatornameAttribute(){
        $Patient = Patiente::find($this->operator);
        return $Patient->lastname. " ". $Patient->firstname;
    }

}
