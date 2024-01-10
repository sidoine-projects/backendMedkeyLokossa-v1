<?php

namespace Modules\Movment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class movment extends Model
{
    use HasFactory;

    protected $fillable = ['incoming_reason','ipp', 'iep','arrivaldate','releasedate','patients_id','uuid','outgoing_reason','is_synced','active_services_id'];

    protected $appends =  ['human_arrival_date','human_release_date','getout'];


    public function getHumanArrivalDateAttribute(){
     return convertToFrenchDate($this->created_at);
 }

 public function getHumanReleaseDateAttribute(){
     return convertToFrenchDate($this->releasedate);
 }


 public function getGetoutAttribute(){
    /* $paid = DB::table('patient_movement_details')
     ->where('movments_id',$this->id)
     ->where('paid',1)->first();
     if($paid){*/
        return $this->releasedate;
     /*}else{
         return 0;
     }*/
 }





    //protected $guarded = [];

    // protected static function newFactory()
    // {
    //     return \Modules\Movment\Database\factories\MovmentFactory::new();
    // }
}
