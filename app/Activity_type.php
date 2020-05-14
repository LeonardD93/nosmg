<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity_type extends Model{
    
     protected $fillable = [
        'id','name', 'game_id','macrocategory','created_at','updated_at'
    ];
    
    public function activities(){
        return $this->hasMany('App\Activity', 'type_id');
    }
    public function game(){
        return $this->belongsTo('App\Game', 'game_id');        
    }
}
