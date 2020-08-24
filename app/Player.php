<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'id','level', 'name', 'class','created_at','updated_at'
    ];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

     public function guild(){
        return $this->belongsTo('App\Guild','guild_id');
    }

    public function game(){
        return $this->belongsTo('App\Game', 'game_id');
    }

    public function activity_organizing(){// attivita di cui è organizzatore
        return $this->hasMany('App\Activity','organizer_id');
    }

    public function request_activity_sent(){// inviti inviati ad attività
        return $this->hasMany('App\RequestActivity','sender_id');
    }

    public function request_activity_recived(){ // inviti ricevuti alle attivita
         return $this->hasMany('App\RequestActivity','recipient_id');
    }

    public function activites(){ // attivita a cui partecipo molti a molti
        return $this->belongsToMany('App\Activity', 'ActivityPlayer','player_id', 'activity_id');
    }
     public function params(){
        return $this->belongsToMany('App\Param')->withPivot('value');//set a value in table param_player
    }
    public function paramPlayer(){
        return $this->hasMany('App\ParamPlayer');
    }
}
