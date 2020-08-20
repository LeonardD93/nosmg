<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class Param_player extends Model{
    public $timestamps = false;
     protected $table = 'param_player';
    protected $fillable = [
        'id', 'value'
    ];

    public function player(){
        return $this->belongsTo('App\Player', 'player_id');
    }
    public function param(){
        return $this->belongsTo('App\Param', 'param_id');
    }
    public function name(){
       return $this::param()->first()->name;
    }
}
