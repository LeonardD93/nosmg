{{--player--}}
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                         <h1> {{__('Create Player')}}</h1>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('players.store') }}" >
                             {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name" class="col-md-4 control-label">{{__('Name')}}</label>
                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control" name="name" required>
                                    </div>
                                </div>
                             @php /*dump($games->count());*/ @endphp
                            @if($games->count()>1)
                            <div class="form-group">
                                 <label for="game_id" class="col-md-4 control-label">{{__('Game')}}</label>
                                  <div class="col-md-6">
                                      <select id="game_id"  class="form-control" name="game_id" >
                                            @foreach ($games as $game) 
                                                <option value="{{$game->id}}">{{$game->name}}</option>
                                            @endforeach  
                                      </select>
                                  </div>
                            </div>
                            @else
                                 <input id="game_id" type="hidden" class="form-control" name="game_id" value="{{$games[0]->id}}" >
                            @endif
                             
                            <div class="form-group">
                                <label for="level" class="col-md-4 control-label">{{__('Level')}}</label>
                                <div class="col-md-6">
                                    <input id="level" type="number" class="form-control" name="level" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="class" class="col-md-4 control-label">{{__('Class')}}</label>
                                <div class="col-md-6">
                                    <input id="class" type="class" class="form-control" name="class" required>
                                </div>
                            </div>
                            {{--extra params--}}
                            @foreach ($extra_params as $extra_param)
                                <div class="form-group">
                                    <label for="extra_{{$extra_param->id}}" class="col-md-4 control-label">{{__($extra_param->name)}}</label>
                                    <div class="col-md-6">
                                        @if($extra_param->type!='textarea')
                                        <input id="extra_{{$extra_param->id}}" type="{{$extra_param->type}}" class="form-control" name="extra_params[{{$extra_param->id}}]" @if($extra_param->required) required @endif>
                                        @else
                                            <textarea id="extra_{{$extra_param->id}}" class="form-control" name="{{$extra_param->id}}" @if($extra_param->required) required @endif ></textarea>
                                        @endif
                                    </div>
                                </div>
                                
                            @endforeach

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