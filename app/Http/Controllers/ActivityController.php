<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use App\ActivityType;
use \App\ActivityPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public static function user_organizer( $user ,$activity){
        return $user->players()->where('id', $activity->organizer_id)->exists();

        // return $user->players()->pluck('id')->contains($activity->organizer_id);

        // return $user->players()
        // ->whereHas('activity_organizing', function($q) use($activity) {
        //     $q->where('id', $activity->id);
        // })->exists();

        // $players=$user->players()->with('activities')->get();
        // $organizer=false;
        // foreach($players as $player){
        //     if($player->id==$activity->organizer_id)
        //         $organizer=true;
        //    /* $activities=$player->activities()->get();
        //     foreach($activities as $activity){
        //     }
        //     */
        // }
        // return $organizer;
    }
    /*
    public function my_activities(){
        $user = Auth::user();
        $players=$user->players()->get();
        $activities=[];
        foreach($players as $player){
            $activities_p=$player->activites()->get();
            foreach($activities_p as $activity){
                $organizer=$activity->organizer()->first()->name;
                $activity['organizer']=$organizer;
               $activities[]=$activity;
            }
        }
        return $activities;//$players; //
    }
    */


    public function getAllActivity(){
        $user = Auth::user();
        $activities=Activity::get();
        $activities_out=[];
        foreach($activities as $activity){
            $organizer=$activity->organizer()->first()->name;
            $type=$activity->ActivityType()->first();
            $type_name=$type->name;
            $macrocategory=$type->macrocategory;
            $activity['organizer_name']=$organizer;
            $activity['user_organizer']=self::user_organizer( $user ,$activity);
            $activity['type_name']=$type_name;
            $activity['macrocategory']=$macrocategory;
            $activities_out[]=$activity;
        }
        return $activities_out;
    }

    public function index()
    {
        //$user = Auth::user();
        $activities=$this::getAllActivity();//$user->activities();
        return view('activity.index', ['activities'=>$activities]);//getAllActivity()]);
    }

    public function create()
    {//show the form to store info
        $user = Auth::user();
        if($user){
            $players=$user->players()->get();
            $ActivityTypes= ActivityType::get(); // controlli in base al game

            return view('activity.create', ['players'=>$players, 'ActivityTypes'=>$ActivityTypes]);
        }

    }

    public function store(Request $request)
    {
        $user = Auth::user();

        if($user){
            $players=$user->players()->get();
            $user_player=false;
            foreach($players as $player){
                if($player->id==$request->organizer_id)
                    $user_player=true;
            }
            if($user_player){
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
                return redirect() ->route('activities.edit', $activity);
            }
           else return redirect() ->route('activities.index')->with('error', 'No permissions');
        }
        else return redirect() ->route('activities.index')->with('error', 'No permissions');
    }

    public function show(Activity $activity)
    {
        //
    }

    public function edit(Activity $activity)
    {
        $user = Auth::user();
        $is_organizer=self::user_organizer($user, $activity);
        if($user && $is_organizer){
            $players=$user->players()->get();
            $ActivityTypes= ActivityType::get();
         return view('activity.edit', ['activity'=>$activity, 'players'=>$players, 'ActivityTypes'=>$ActivityTypes]);
        }
         else return redirect() ->route('activities.index')->with('error', 'No permissions');
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

    public function destroy(Activity $activity)
    {
        $user=$user = Auth::user();
        $is_organizer=self::user_organizer($user, $activity);
        if($user && $is_organizer){
            $ActivityPlayers=$activity->ActivityPlayer()->get();
            foreach($ActivityPlayers as $ActivityPlayer ){
                $ActivityPlayer->delete();
            }
            $activity->delete();
         return redirect() ->route('activities.index')->with('success', 'Deleted successful');
        }
        else
            return redirect() ->route('activities.index')->with('error', 'No permissions');
    }
}
