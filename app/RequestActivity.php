<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequestActivity extends Model
{
    protected $fillable = [
        'id','status', 'created_at','updated_at'
    ];
    public function sender(){
        return $this->belongsTo('App\User', 'sender_id');
    }
    public function recipient(){
        return $this->belongsTo('App\User', 'recipient_id');
    }
    public function activity(){
        return $this->belongsTo('App\Activity', 'activity_id');
    }
}
