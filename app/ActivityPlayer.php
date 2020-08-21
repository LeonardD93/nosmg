<?php

namespace App;// questa classe in realta non dovrebbe esserci in quanto è la classe intermedia molti a molti
use Illuminate\Database\Eloquent\Model;
/**
 * Description of ActivityPlayer
 *
 * @author Leonard
 */
class ActivityPlayer extends Model {
    public $timestamps = false;
    protected $table = 'ActivityPlayer';
    protected $fillable = [
        'id',
    ];
    public function player(){
        return $this->belongsTo('App\Player', 'player_id');
    }
     public function activity(){
        return $this->belongsTo('App\Activity', 'activity_id');
    }

}
