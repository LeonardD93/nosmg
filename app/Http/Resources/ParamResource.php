<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParamResource extends JsonResource
{
    public function toArray($request)
    {
        return[
            'name'=>$this->name,
            'active'=>$this->active,
            'id'=>$this->id,
            'multiple'=>$this->multiple,
            'required'=>$this->required,
            'type'=>$this->type,
            'game_id'=>$this->game_id,
            'game'=>$this->game->name,
        ];
    }
}
