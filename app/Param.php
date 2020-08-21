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

    public function ActivityParam(){
        return $this->hasMany('App\ActivityParam', 'param_id');
    }
    public function ParamPlayer(){
        return $this->hasMany('App\ParamPlayer', 'param_id');
    }
}
