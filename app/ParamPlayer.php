<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class ParamPlayer extends Model{
    //public $timestamps = false;
    protected $table = 'param_player';//tabella many to many
    protected $fillable = [
        'id', 'value','created_at','updated_at'
    ];

    public function player(){
        return $this->belongsTo('App\Player', 'player_id');
    }
    public function param(){
        return $this->belongsTo('App\Param', 'param_id');
    }
    public function getParamNameAttribute(){
       return $this->param->name;
    }
}
