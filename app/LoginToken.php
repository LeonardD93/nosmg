<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginToken extends Model{
    public $timestamps = false;
    protected $table = 'login_tokens';
    protected $fillable = [
        'value', 'expires_at'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function generateLoginToken($user_id) {
        $this->value = substr(md5(rand(0, 9) . $this->email . $user_id. time()), 0, 32);
        return $this->value;
    }
}
