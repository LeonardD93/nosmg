<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'id','name', 'description','created_at','updated_at'
    ];
      
    public function activities_type(){
        return $this->hasMany('App\ActivityType', 'game_id');
    }
    public function params(){
        return $this->hasMany('App\Param', 'game_id');
    }
     public function players(){
        return $this->hasMany('App\Player', 'game_id');
    }
}
