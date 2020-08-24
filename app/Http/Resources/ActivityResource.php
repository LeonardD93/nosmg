<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $type=$this->ActivityType()->first();
        return [
            'name'=>$this->name,
            'organizer_name'=>$this->organizer()->first()->name,
            'start_date'=>$this->start_date,
            'level_req'=>$this->level_req,
            'type_name'=>$type->name,
            'macrocategory'=>$type->macrocategory,
            'users_number'=>$this->users_number,
            'other_req'=>$this->other_req,
            'user_organizer'=>Auth::user()->players()->where('id', $this->organizer_id)->exists(),
        ];
    }
}
