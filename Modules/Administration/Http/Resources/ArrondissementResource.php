<?php

namespace Modules\Administration\Http\Resources;

// use Modules\Acl\Http\Resources\User:Resource;
use Modules\Administration\Http\Resources\CommuneResource;
// use Modules\Absence\Http\Resources\MissionResource;
// use Modules\Absence\Http\Resources\VacationResource;

class ArrondissementResource extends \App\Http\Resources\BaseResource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // $acl = $this->displayAcl("Absent");
        return [
            "id" => $this->id,
            'nom' => $this->nom,

            'communes' => new CommuneResource($this->commune),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // 'acl' => :$acl,
        ];
    }
}
