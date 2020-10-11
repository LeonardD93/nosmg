{{--activity--}}
@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <a href='{{route('activities.create')}}' class="btn btn-primary ">{{ __('Add new') }}</a>
        </div>
    </div>
    <table id='activity_table' class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Organizer') }}</th>
                <th>{{ __('Start date') }}</th>
                <th>{{ __('Level required') }}</th>
                <th>{{ __('Type') }}</th>
                <th>{{ __('Macrocategory') }}</th>
                <th>{{ __('User number') }}</th>
                <th>{{ __('Other Requests') }}</th>
                <th>{{ __('Actions') }}</th>       
            </tr>
        </thead>
        <tbody>
            @foreach($activities as $activity)
            <tr>
                <td>{{$activity->name}}</td>
                <td>{{$activity->organizer_name}}</td>
                <td>{{$activity->start_date}}</td>
                <td>{{$activity->level_req}}</td>
                <td>{{$activity->type_name}}</td>
                <td>{{$activity->macrocategory}}</td>
                <td>{{$activity->users_number}}</td>
                <td>{{$activity->other_req}}</td>
                <td>
                    @if($activity->user_organizer)
                        <a class="btn btn-info btn-sm" href='{{route('activities.edit', $activity)}}'>edit</a>
                        <form action="{{route('activities.destroy', $activity)}}" method="post" data-message="Delete this Thing?" class="delete_form">
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