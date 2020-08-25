<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityTypeResource extends JsonResource
{
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'macrocategory'=>$this->macrocategory,
            'game'=>$this->game->name,
            'game_id'=>$this->game_id

        ];
    }
}
