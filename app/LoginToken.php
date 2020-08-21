<?php


namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LoginToken extends Model{
    public $timestamps = false;
    protected $table = 'login_tokens';
    protected $fillable = [
        'value', 'expires_at'
    ];
    public $hidden = [
            'id', 'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
    public function generateLoginToken($user_id) {
        $this->value = Str::random(60);
        return $this->value;
    }

    static function generateToken() {
        return Str::random(60);
    }
}
