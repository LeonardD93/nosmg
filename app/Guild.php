<?php


namespace App;
use Illuminate\Database\Eloquent\Model;

class Guild extends Model{
    
    protected $fillable = [
        'id','name','created_at','updated_at'
    ];
    
    public function boss(){
        return $this->belongsTo('App\User', 'boss_id');        
    }
    public function vice1(){
        return $this->belongsTo('App\User', 'vice1_id');        
    }
    public function vice2(){
        return $this->belongsTo('App\User', 'vice2_id');        
    }   
}
