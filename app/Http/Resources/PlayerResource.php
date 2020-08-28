<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\ParamPlayer;
use App\Http\Resources\ParamPlayerResource;

class PlayerResource extends JsonResource
{
    public function toArray($request)
    {
        //retrun $this;
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'level'=>$this->level,
            'class'=>$this->class,
            'game_id'=>$this->game_id,
            'game'=>$this->game,
            'extra_params'=>$this->paramPlayer->pluck('value', 'param_name'),
        ];
    }
}
