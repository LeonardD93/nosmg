<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'id','email', 'invitation_token', 'created_at','message','invited_by_user'
    ];
    
    public function generateInvitationToken($user_id) {
      
        $this->invitation_token = substr(md5(rand(0, 9) . $this->email . $user_id. time()), 0, 32);
    }
    
    public function getLink() {
        return urldecode(route('register') . '?invitation_token=' . $this->invitation_token);
    }
}
