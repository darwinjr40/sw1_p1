<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id' => $this->id,
            'nombre' => $this->nombre, 
            'descripcion' => $this->descripcion,
            //es para que nos retorne las relaciones.
            //  'eventos' => EventResource::collection($this->whenLoaded('eventos')), 
            //  'sector' => SectorResource::make($this->whenLoaded('sector')),           
        ];
    }
}