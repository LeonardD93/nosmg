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
            'extra_params'=>$this->paramPlayer->pluck('value', 'param_name'),
        ];
        // {
        //     "specialist" => 3,
        //     "asdf" => 123,
        // }
        // player.params.specialist
        // player.params.specialistasd = 123
        // [
        //     { "name": "specialist", value: 123 },
        //     { "name": "specialist", value: 123 },
        //     { "name": "specialist", value: 123 },
        // ]
        // let info = player.params.find(param => param.name == 'specialist')
        // if (info) return info.value
        // else return null
        //
        // let info = player.params.find(param => param.name == 'specialist')
        // if (info) info.value = 123
        // else player.params.push({ name: 'specialist', value: 123 })


    }
}
