<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'id','name', 'start_date', 'level_req','type_id','users_number', 'other_req','created_at','updated_at','organizer_id'
    ];

    public function organizer(){//organizer puo avere piu attività
        return $this->belongsTo('App\Player', 'organizer_id');
    }

     public function players(){//relazione many to many salvate nella users_activities
        return $this->belongsToMany('App\Player','ActivityPlayer', 'activity_id','player_id');
    }

    public function ActivityType(){//piu attivita dello stesso tipo
        return $this->belongsTo('App\ActivityType', 'type_id');
    }

    public function ActivityParam(){
        return $this->hasMany('App\ActivityParam', 'activity_id');
    }

    public function request_activity(){
        return $this->hasMany('App\RequestActivity', 'activity_id');
    }

    public function ActivityPlayer(){
        return $this->hasMany('App\ActivityPlayer', 'activity_id');
    }

}
