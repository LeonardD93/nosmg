<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Activity;
use App\Http\Resources\ActivityResource;
use Illuminate\Support\Facades\Auth;
use \App\ActivityPlayer;

class ActivityController extends Controller
{
    public function index(){
        //return ActivityResource::collection(Activity::get());
        return ActivityResource::collection(Activity::with(['ActivityType', 'organizer.user'])->get());
    }
    public function storeUpdate(Request $request){
        $user = Auth::user();
        $organizer_auth =$user->players->where('id',$request->organizer_id)->first();

        if($organizer_auth){
            if(request('id')){
                $activity= Activity::where(
                    'id', '=', request('id'))
                    ->where('organizer_id', '=', $organizer_auth->id)->first();
                 if(!$activity)
                      return ['error'=>'not allowed','message'=>"you are not the organizer"];
            }
            else
                $activity=new Activity();

            $activity->name=$request->name;
            $activity->organizer_id=$request->organizer_id;
            $activity->start_date=$request->start_date;
            $activity->start_time=$request->start_time;
            $activity->level_req=$request->level_req;
            $activity->type_id=$request->type_id;
            $activity->users_number=$request->users_number;
            $activity->other_req=$request->other_req;
            $activity->save();
            if(!request('id')){
                $ActivityPlayer=new ActivityPlayer();
                $ActivityPlayer->player_id=$request->organizer_id;
                $ActivityPlayer->activity_id=$activity->id;
                $ActivityPlayer->save();
            }
            return ['success'];
        }
        else return ['error'=>'not allowed','message'=>"you are not authenticated"];
    }

    public function destroy(request $request){
        $user = Auth::user();
        $organizer_auth =$user->players->where('id',$request->organizer_id)->first();
        if($organizer_auth){
            $activity= Activity::where(
                'id', '=', request('id'))
                ->where('organizer_id', '=', $organizer_auth->id)->first();
            $activity->ActivityPlayer()->delete();
            $activity->delete();
        }
    }

}
