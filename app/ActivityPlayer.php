<?php

namespace App;// questa classe in realta non dovrebbe esserci in quanto è la classe intermedia molti a molti
use Illuminate\Database\Eloquent\Model;
/**
 * Description of ActivityPlayer
 *
 * @author Leonard
 */
class ActivityPlayer extends Model {

    protected $table = 'activity_player';
    protected $fillable = [
        'id','created_at','updated_at'
    ];
    public function player(){
        return $this->belongsTo('App\Player', 'player_id');
    }
     public function activity(){
        return $this->belongsTo('App\Activity', 'activity_id');
    }

}
