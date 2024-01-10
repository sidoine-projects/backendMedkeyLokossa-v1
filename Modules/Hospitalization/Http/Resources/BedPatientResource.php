<?php

namespace Modules\Hospitalization\Http\Resources;

use Carbon\Carbon;
use Modules\Acl\Http\Resources\UserResource;
use Modules\Patient\Http\Resources\PatienteResource;

class BedPatientResource extends \App\Http\Resources\BaseResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function toArray($request) 
    {
        // $acl = $this->displayAcl("Category");

        return [
            'uuid' => $this->uuid,
            'comment' => $this->comment,
            'start_occupation_date' => Carbon::parse($this->start_occupation_date)->format('d-m-Y H:i:s'),
            'end_occupation_date' => Carbon::parse($this->end_occupation_date)->format('d-m-Y H:i:s'),

            'bed' => new BedResource($this->bed),
            'patient' => new PatienteResource($this->patient),
            // 'user' => new UserResource($this->user),

            'is_synced' => $this->is_synced,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // 'acl' => $acl,
        ];
    }
}
