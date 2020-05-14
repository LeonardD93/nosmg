<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Player_param extends Model{
    protected $fillable = [
        'id', 'value','created_at','updated_at'
    ];
   
    public function player(){
        return $this->belongsTo('App\layer', 'player_id');        
    }
    public function param(){
        return $this->belongsTo('App\Param', 'param_id');        
    }
  
}
