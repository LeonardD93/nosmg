<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\PlayerResource;
use App\Http\Resources\ParamPlayerResource;
use App\Player;
use App\ParamPlayer;

class PlayerController extends Controller {
    public function index(){
        $user=Auth::user();
        $players = $user->players()
            ->with(['paramPlayer', 'paramPlayer.param'])
            ->get();
        return PlayerResource::collection($players);
    }

    public function storeUpdate(Request $request)
    {
        //return $request;
        $user = Auth::user();
        if($user){
            $player = request('id')
                    ? $user->players()->findOrFail(request('id'))
                    : new Player();
            $player->name=$request->name;
            $player->game_id=$request->game_id;
            $player->level=$request->level;
            $player->class=$request->class;
            $player->user_id=$user->id;

            $player->save();
            //dump($request->all());
            if($request->extra_params){
                $player->paramPlayer()->delete();
                foreach($request->extra_params as $param_name=>$value){
                    if (!mb_strlen($value)) continue;
                    $param = $player->game->params->firstWhere('name', $param_name);
                    if (!$param) continue;
                    $ParamPlayer=new ParamPlayer();
                    $ParamPlayer->player_id=$player->id;
                    $ParamPlayer->param_id=$param->id;
                    $ParamPlayer->value=$value;
                    $ParamPlayer->save();
                }
            }
            return $player;
        }
        else return ['error'=>'not allowed'];
    }
    public function destroy(request $request){
        $user = Auth::user();
        if($user){
            $player=$user->players()->findOrFail(request('id'));
            if($user->id==$player->user_id || $user->isAdmin()){
                $player->paramPlayer()->delete();
                $player->activity_organizing()->delete();
                $player->delete();
                return ['success'];
            }
        }
        return ['error'=>'not allowed'];
    }

}
