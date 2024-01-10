<?php

namespace Modules\Hospitalization\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BedsResource extends ResourceCollection
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
            'data' => BedResource::collection($this->collection),
        ];
    }
}
