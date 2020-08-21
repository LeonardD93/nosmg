<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ActivityParam extends Model{
   protected $fillable = [
        'id','param_id', 'value','created_at','updated_at'
    ];

    public function activity(){
        return $this->belongsTo('App\Activity', 'activity_id');
    }
    public function param(){
        return $this->belongsTo('App\Param', 'param_id');
    }
}
