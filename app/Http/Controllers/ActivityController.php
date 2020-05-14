<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function user_organizer( $user ,$activity){
        $players=$user->players()->get();
        $organizer=false;
        foreach($players as $player){
            if($player->id==$activity->organizer_id)
                $organizer=true;
           /* $activities=$player->activities()->get();
            foreach($activities as $activity){     
            }
            */  
        }
        return $organizer;
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
            $type=$activity->activity_type()->first();
            $type_name=$type->name;
            $macrocategory=$type->macrocategory;
            $activity['organizer_name']=$organizer;
            $activity['user_organizer']=$this::user_organizer( $user ,$activity);
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
        
        return view('activity.create');
        
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Activity $activity)
    {
        //
    }

    public function edit(Activity $activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        //
    }
}
