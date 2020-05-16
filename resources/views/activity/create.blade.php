
{{--activity--}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <h1> {{__('Create Activity')}}</h1>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('activities.store') }}" >
                             {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">{{__('Name')}}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                            
                            @if($players->count()>1)
                            <div class="form-group">
                                 <label for="organizer_id" class="col-md-4 control-label">{{__('Player')}}</label>
                                  <div class="col-md-6">
                                      <select id="organizer_id"  class="form-control" name="organizer_id" >
                                            @foreach ($players as $player) 
                                                <option value="{{$player->id}}">{{$player->name}}</option>
                                            @endforeach  
                                      </select>
                                  </div>
                            </div>
                            @else
                                 <input id="organizer_id" type="hidden" class="form-control" name="organizer_id" value="{{$players[0]->id}}" >
                            @endif
                             
                            <div class="form-group">
                                <label for="start_date" class="col-md-4 control-label">{{__('Start date')}}</label>
                                <div class="col-md-6">
                                    <input id="start_date" type="date" class="form-control" name="start_date" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="start_time" class="col-md-4 control-label">{{__('Start date time')}}</label>
                                <div class="col-md-6">
                                    <input id="start_time" type="time" class="form-control" name="start_time" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="level_req" class="col-md-4 control-label">{{__('Level required')}}</label>
                                <div class="col-md-6">
                                    <input id="level_req" type="number" class="form-control" name="level_req" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                 <label for="type_id" class="col-md-4 control-label">{{__('Activity type')}}</label>
                                  <div class="col-md-6">
                                      <select id="type_id"  class="form-control" name="type_id" >
                                            @foreach ($activity_types as $activity_type)
                                                <option value="{{$activity_type->id}}">{{$activity_type->name}}</option>
                                            @endforeach  
                                      </select>
                                  </div>
                            </div>
                            
                             <div class="form-group">
                                <label for="users_number" class="col-md-4 control-label">{{__('User number')}}</label>
                                <div class="col-md-6">
                                    <input id="users_number" type="number" class="form-control" name="users_number" required>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="other_req" class="col-md-4 control-label">{{__('Other requests')}}</label>
                                <div class="col-md-6">
                                    <textarea id="other_req" name="other_req"></textarea>
                                </div>
                            </div>
                            
                            
                            

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{__('Create')}}
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection