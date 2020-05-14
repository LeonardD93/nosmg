<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [
        'id','name', 'start_date', 'level_req','type_id','users_number', 'other_req','created_at','updated_at'
    ];
   
    public function organizer(){//organizer puo avere piu attività
        return $this->belongsTo('App\Player', 'organizer_id');
    }
    
     public function players(){//relazione many to many salvate nella users_activities
        return $this->belongsToMany('App\Player','activity_player', 'activity_id','player_id');
    }
    
    public function activity_type(){//piu attivita dello stesso tipo
        return $this->belongsTo('App\Activity_type', 'type_id');        
    }
   
    public function activity_param(){
        return $this->hasMany('App\Activity_param', 'activity_id');    
    }
    
    public function request_activity(){
        return $this->hasMany('App\Request_activity', 'activity_id');
    }     
}
