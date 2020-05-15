<?php

namespace App;
use Illuminate\Database\Eloquent\Model;


class Param extends Model{
    
     protected $fillable = [
        'id','name','created_at','updated_at'
    ];
     public function game(){//
        return $this->belongsTo('App\Game', 'game_id');
    }
    
    public function activity_param(){
        return $this->hasMany('App\Activity_param', 'param_id');    
    }
    public function param_player(){
        return $this->hasMany('App\Param_player', 'param_id');    
    }
}
