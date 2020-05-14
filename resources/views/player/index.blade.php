@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <a href='{{route('players.create')}}' class="btn btn-primary ">{{ __('Add new') }}</a>
        </div>
    </div>
    <table id='player_table' class="table table-striped table-bordered">
        <thead>
            <tr>

                <th>{{ __('Name') }}</th>
                <th>{{ __('Game') }}</th>
                <th>{{ __('Level') }}</th>
                <th>{{ __('Class') }}</th>
                
                <th>{{ __('Actions') }}</th>       
            </tr>
        </thead>
        <tbody>
            @foreach($players as $player)
            <tr>
                <td>{{$player->name}}</td>
                <td>{{$player->game()->first()->name}}</td>
                <td>{{$player->level}}</td>
                <td>{{$player->class}}</td>
                
                <td><a class="btn btn-info btn-sm">buttons actions</a></td>

            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection