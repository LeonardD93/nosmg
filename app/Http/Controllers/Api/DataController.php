<?php
namespace App\Http\Controllers\Api;
use App\Activity;
use App\User;
use App\ActivityType;
use \App\ActivityPlayer;
use \App\Param;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Resources\PlayerResource;
use App\Http\Resources\ActivityResource;
use App\Http\Resources\ActivityTypeResource;
use App\Http\Resources\ParamResource;

class DataController extends Controller
{
  public function index()
  {
    $user=Auth::user();
    return [
      'user'=>$user,
      'games'=>\App\Game::all(),
      'players'=>PlayerResource::collection($user->players),
      'activities'=>ActivityResource::collection(Activity::get()),
      'activitiesType'=>ActivityTypeResource::collection(ActivityType::get()),
      'params'=>ParamResource::collection(Param::get()),
  ];
  }
}
