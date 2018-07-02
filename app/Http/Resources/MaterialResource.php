<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MaterialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => $this->type,
            'image' => $this->image,
            'locations' => $this->locations,
            'size' => $this->size,
            'lifespan' => $this->lifespan,
            'diet' => $this->diet,
            'description' => $this->description,


        ];
    }
}
