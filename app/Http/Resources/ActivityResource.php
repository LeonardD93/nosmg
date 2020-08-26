<?php
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class ActivityResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'organizer_name'=>$this->organizer->name,
            'start_date'=>$this->start_date,
            'level_req'=>$this->level_req,
            'type_name'=>$this->ActivityType->name,
            'macrocategory'=>$this->ActivityType->macrocategory,
            'users_number'=>$this->users_number,
            'other_req'=>$this->other_req,
            'user_organizer_id'=>$this->organizer->user->id,
        ];
    }
}
