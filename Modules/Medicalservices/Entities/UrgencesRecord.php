<?php

namespace Modules\Medicalservices\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UrgencesRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid',
        'services_id',
        'movments_id',
        'category',
        'level',
        'description',
        'emergency_actions',
        'parent',
        'summary',
        'operator'
    ];

    protected static function newFactory()
    {
        return \Modules\Medicalservices\Database\factories\UrgencesRecordFactory::new();
    }

    public function getOperatornameAttribute(){
        $Patient = Patiente::find($this->operator);
        return $Patient->lastname. " ". $Patient->firstname;
    }
}
