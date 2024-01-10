<?php

namespace Modules\Absence\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Absence\Entities\Vacation;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TypeVacation extends Model
{
    protected $guarded = [];
    use HasFactory;
 
    public function vacations(){
        return $this->hasMany(Vacation::class)->orderby('create_at', 'DESC');

    }   

}
