<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ParamPlayerResource extends JsonResource
{
    
    public function toArray($request){
        return[
            'name'=>$this->name(),
            'value'=>$this->value,
        ];
    }
}
