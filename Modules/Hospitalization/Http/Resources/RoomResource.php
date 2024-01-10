<?php

namespace Modules\Hospitalization\Http\Resources;

use Modules\Acl\Http\Resources\UserResource;

class RoomResource extends \App\Http\Resources\BaseResource {

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
    */
    public function toArray($request) {
        // $acl = $this->displayAcl("Room");
        $bedCount = $this->beds->count();

        return [
            'uuid' => $this->uuid,
            'code' => $this->code,
            'name' => $this->name,
            'bed_capacity' => $this->bed_capacity,
            'price' => $this->price,
            'description' => $this->description,
            'bed_count' => $bedCount,
            
            // 'user' => new UserResource($this->user),

            'is_synced' => $this->is_synced,
            'deleted_at' => $this->deleted_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            // 'acl' => $acl,
        ];
    }
}
