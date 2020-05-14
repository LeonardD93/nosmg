<?php

namespace App\Http\Controllers;

use App\Player;
use App\Game;
use App\Param;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $players=$user->players()->get();
        return view('player.index', ['players'=>$players]);
    }

    public function create()
    {
        $games= Game::get();
        //dump($games);
        $extra_params=Param::get()->where('active');//->where('required',1);
        return view('player.create', ['games'=>$games,'extra_params'=>$extra_params]);// da gestire meglio tramite ajax in quanto dipende dal game_id
    }

    public function store(Request $request)
    {
       
    }

    public function show(Player $player)
    {

    }

    public function edit(Player $player)
    {

    }

    public function update(Request $request, Player $player)
    {

    }

    public function destroy(Player $player)
    {

    }
}
