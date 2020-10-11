<?php
namespace App\Http\Controllers\Api;
use App\Activity;
use App\User;
use App\ActivityType;
use \App\ActivityPlayer;
use \App\Param;
use \App\Game;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Resources\PlayerResource;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityTypeResource;
use App\Http\Resources\ParamResource;
use App\Http\Resources\GameResource;
use App\Http\Resources\UserResource;

class DataController extends Controller
{
  public function index()
  {
    $user=Auth::user();
    $players = $user->players()
        ->with(['paramPlayer', 'paramPlayer.param'])
        ->get();

    \Log::debug("start return");
    return [
      'games'=>GameResource::collection(Game::get()),
      'players'=>PlayerResource::collection($players),
      'activities'=>ActivityResource::collection(Activity::with(['ActivityType', 'organizer.user','players' ])->get()), //'ActivityPlayer',''
      'activitiesType'=>ActivityTypeResource::collection(ActivityType::with('game')->get()),
      'params'=>ParamResource::collection(Param::with('game')->get()),
      'user'=>['id'=>$user->id,
              'name'=>$user->name,
              'email'=>$user->email,
              'type'=>$user->type,],
        //' ],//UserResource::collection($user
      //'invitations'=>
  ];
  }
}
