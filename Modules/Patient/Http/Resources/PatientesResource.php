<?php

namespace Modules\Patient\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PatientesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => PatienteResource::collection($this->collection),
        ];
    }
}
