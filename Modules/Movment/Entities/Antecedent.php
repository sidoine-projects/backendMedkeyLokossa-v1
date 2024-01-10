<?php

namespace Modules\Movment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Antecedent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'movments_id' , 'patients_id', 'description','uuid'];
protected $appends =  ['human_arrival_date'];

 public function getHumanArrivalDateAttribute(){
       return $this->created_at->format("d/m/Y H:i");
   }
    protected static function newFactory()
    {
        return \Modules\Movment\Database\factories\AntecedentFactory::new();
    }
}
