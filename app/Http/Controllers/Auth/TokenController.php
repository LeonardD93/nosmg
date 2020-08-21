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
        $user=User::where('email', $request->email)->first();
        if($user && Hash::check($request->password,$user->password)){
            $loginToken = $user->loginTokens()->create([
                'value' => LoginToken::generateToken(),
                'expires_at' => Carbon::now(),
            ]);
            // return 123;
                // $loginToken=new LoginToken();
                // $loginToken->user_id=$user->'password'));
                // $loginToken->generateLoginToken($user->'password'));
                // $loginToken->expires_at=Carbon::now();
                // $loginToken->save();
            return  $loginToken;
        }
        else abort(400, 'credenziali errate');
    }
    public function destroy($token){
        $tk=LoginToken::where('value',$token)->firstOrFail();
        $tk->delete();
    }
}
