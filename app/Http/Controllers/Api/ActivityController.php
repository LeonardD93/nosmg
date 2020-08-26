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
        return ActivityResource::collection(Activity::get());
    }

    // public function store(Request $request){
    //     $user=Auth::user()->players();
    //
    //     return $request;
    // }
    public function store(Request $request)
    {
        $organizer_auth = Auth::user()->players->where('id',$request->organizer_id);
        if($organizer_auth){
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

            $ActivityPlayer=new ActivityPlayer();
            $ActivityPlayer->player_id=$request->organizer_id;
            $ActivityPlayer->activity_id=$activity->id;
            $ActivityPlayer->save();
            return ['success'];
        }
        else return ['error'=>'no permissions'];
    }

    public function update(Request $request, Activity $activity)
    {
        $user = Auth::user();
        $is_organizer=self::user_organizer($user, $activity);
        if($user && $is_organizer){
            $to_update=0;
            if($activity->name!=$request->name ){
                $activity->name=$request->name;
                $to_update=1;
            }
            if($activity->start_date!=$request->start_date ){
                $activity->start_date=$request->start_date;
                $to_update=1;
            }
            if($activity->start_time!=$request->start_time ){
                $activity->start_time=$request->start_time;
                $to_update=1;
            }
            if($activity->level_req!=$request->level_req ){
                $activity->level_req=$request->level_req;
                $to_update=1;
            }
            if($activity->type_id!=$request->type_id ){
                $activity->type_id=$request->type_id;
                $to_update=1;
            }
            if($activity->users_number!=$request->users_number ){
                $activity->users_number=$request->users_number;
                $to_update=1;
            }
            if($activity->other_req!=$request->other_req ){
                $activity->other_req=$request->other_req;
                $to_update=1;
            }
            if($to_update){
                $activity->save();
                return redirect() ->route('activities.index')->with('success', 'Updated successful');
            }
            else{
                return redirect() ->route('activities.index')->with('warning', 'No changes detected');
            }
        }
        else
            return redirect() ->route('activities.index')->with('error', 'No permissions');
    }


}
