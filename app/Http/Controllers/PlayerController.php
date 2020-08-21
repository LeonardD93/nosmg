<?php

namespace App\Http\Controllers;

use App\Player;
use App\Game;
use App\Param;
use App\ParamPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $players=$user->players()->get();
        $params=Param::get()->where('active');
        /* da vedere in seguito se servono altri controlli
        foreach($players as $player){
            $params_extra=$player->params()->get();
            dump($params_extra);
        }
        dump('parametri');
        dump($params);*/
        return view('player.index', ['players'=>$players, 'user'=>$user,'params'=>$params]);
    }

    public function create()
    {
        $games= Game::get();
        //dump($games);
        $extra_params=Param::get()->where('active');//->where('required',1);->where('game_id',$player->game_id);
        return view('player.create', ['games'=>$games,'extra_params'=>$extra_params]);// da gestire meglio tramite ajax in quanto dipende dal game_id
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $player=new Player();
        $player->name=$request->name;
        $player->game_id=$request->game_id;
        $player->level=$request->level;
        $player->class=$request->class;
        $player->user_id=$user->id;

        $player->save();
        //dump($request->all());
        if($request->extra_params){
        foreach($request->extra_params as $key=>$value){
            $ParamPlayer=new ParamPlayer();
            $ParamPlayer->player_id=$player->id;
            $ParamPlayer->param_id=$key;
            $ParamPlayer->value=isset($value) ?$value:'';
            $ParamPlayer->save();
        }
    }
        return redirect() ->route('players.edit', $player);
    }

    public function show(Player $player)
    {
        $extra_params=$player->params()->get();

        return view('player.show',['player'=>$player,'extra_params'=>$extra_params] );
    }

    public function edit(Player $player)
    {
       $user = Auth::user();
       $games= Game::get();
       if($player->user_id==$user->id){
           $params=Param::get()->where('active')->where('game_id',$player->game_id);
           foreach($params as $param){
               $this::add_extra_ParamPlayer($param, $player);
           }
            $extra_params=$player->params()->get();
          return view('player.edit',['player'=>$player,'extra_params'=>$extra_params,'games'=>$games]);
       }
       else return redirect() ->route('players.index')->with('error', 'No permissions');
    }

    public function update(Request $request, Player $player)
    {
        //dump($request->all());
        //dump($player);
        $user = Auth::user();
        if($user && ($user->id==$player->user_id || $user->isAdmin()) ){
            $to_update=0;
            if($player->name!=$request->name ){
                $player->name=$request->name;
                $to_update=1;
            }
            if($player->game_id!=$request->game_id ){
                $player->game_id=$request->game_id;
                $to_update=1;
            }
            if($player->level!=$request->level ){
                $player->level=$request->level;
                $to_update=1;
            }
            if($player->class!=$request->class ){
                $player->class=$request->class;
                $to_update=1;
            }
            if($to_update)
               $player->save();
            $extra_params=$player->params()->get();
            //dump($extra_params);
            foreach($extra_params as $extra_param){
                $param_id=$extra_param->id;
                $param_value=$extra_param->pivot->value;
                if(isset($request->extra_params[$param_id]) && $request->extra_params[$param_id]!=$param_value){
                    $extra_param->pivot->value=$request->extra_params[$param_id];
                    $extra_param->pivot->save();
                    $to_update=1;
                }
            }
            if($to_update)
               return redirect() ->route('players.index')->with('success', 'Updated successful');
            else
                return redirect() ->route('players.index')->with('warning', 'No changes detected');
        }
        else
            return redirect() ->route('players.index')->with('error', 'No permissions');

 //scrivere qui le request da salvare;
    }

    public function destroy(Player $player)
    {
        $user = Auth::user();
        if($user && ($user->id==$player->user_id || $user->isAdmin()) ){
            $extra_params=$player->params()->get();
            foreach($extra_params as $extra_param){
                $extra_param->pivot->delete();
            }
            $player->delete();
            return redirect() ->route('players.index')->with('success', 'Deleted successful');
        }
        else
            return redirect() ->route('players.index')->with('error', 'No permissions');

    }
    public function add_extra_ParamPlayer($param, $player){
        $extra_params=$player->params()->get();
        $found=0;
        foreach($extra_params as $extra){
            if($extra->id==$param->id)
                 $found=1;
        }
        if(!$found){
            $ParamPlayer=new ParamPlayer();
            $ParamPlayer->player_id=$player->id;
            $ParamPlayer->param_id=$param->id;
            $ParamPlayer->value='';
            $ParamPlayer->save();
        }

    }

}
