@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @if (session('error'))
                <div class="alert alert-danger">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('warning'))
                <div class="alert alert-warning">
                    <p>{{ session('warning') }}</p>
                </div>
            @endif
            
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <a href='{{route('players.create')}}' class="btn btn-primary ">{{ __('Add new') }}</a>
        </div>
    </div>
    <table id='player_table' class="table table-striped table-bordered">
        <thead>
            <tr>

                <th>{{ __('Name') }}</th>
                <!--<th>{{ __('Game') }}</th>-->
                <th>{{ __('Level') }}</th>
                <th>{{ __('Class') }}</th>              
                @foreach($params as $param)
                 <th>{{$param->name}}</th>
                @endforeach
                <th>{{ __('Actions') }}</th>       
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                <td>{{$player->name}}</td>
                <!--<td>{{$player->game()->first()->name}}</td>-->
                <td>{{$player->level}}</td>
                <td>{{$player->class}}</td>
                
                 @foreach($player->params()->get() as $param)
                 <td>{{$param->pivot->value}}</td>
                 @endforeach
                
                <td>
                    @if($user->id==$player->user_id)
                        <a class="btn btn-info btn-sm" href='{{route('players.edit', $player)}}'>edit</a>                      
                        <form action="{{route('players.destroy', $player)}}" method="post" data-message="Delete this Thing?" class="delete_form">
                             @method('DELETE') 
                             @csrf
                            <input class="btn btn-info btn-sm" type="submit" value="Delete" />
                            
                        </form>
                    @endif
                   
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection