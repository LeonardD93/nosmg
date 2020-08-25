<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\ParamPlayer;
use App\Http\Resources\ParamPlayerResource;

class PlayerResource extends JsonResource
{
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'level'=>$this->level,
            'class'=>$this->class,
            'extra_params'=>ParamPlayerResource::collection($this->paramPlayer()->get()),
        ];
    }
}
