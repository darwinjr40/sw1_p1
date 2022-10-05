<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'titulo' => $this->titulo, 
            'tipo' => $this->tipo,
            'descripcion' => $this->descripcion,
            'fecha' => $this->fecha,
            //es para que nos retorne las relaciones.
            //  '' => UbicacionResource::collection($this->whenLoaded('ubicaciones')), 
             'category' => CategoryResource::make($this->whenLoaded('categoria')),           
        ];
    }
}
