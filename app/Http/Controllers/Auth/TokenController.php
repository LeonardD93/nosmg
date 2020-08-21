<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\LoginToken;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TokenController extends Controller
{
    public function store(Request $request)
    {
        $user=User::where(
            [['email','=', $request->email]]);
        if($user && Hash::check($request->password,$user->value('password'))){
            $loginToken=LoginToken::where('id', $user->value('id'));
            if(!$loginToken){
                $loginToken=new c();
                $loginToken->user_id=$user->value('id');
                $loginToken->generateLoginToken($user->value('id'));
                $loginToken->expires_at=Carbon::now();
                $loginToken->save();
            }
            else{
                $loginToken->update(['expires_at'=>Carbon::now()]);
            }
            return  ['token'=>$loginToken->value('value')];
        }
        else abort(400, 'credenziali errate');
    }
    public function destroy($token){
        $tk=LoginToken::where('value',$token);
        if($tk)
            $tk->delete();
    }
}
