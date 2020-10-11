<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ParamPlayerResource extends JsonResource
{
    public function toArray($request){
        return[
            'id'=>$this->id,
            'name'=>$this->getName(),
            'value'=>$this->value,
        ];
    }
}
