
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="page-header" style="margin-top: 0">
            <h1>{{__('Invitations')}} </h1>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <a href='{{route('invitations.create')}}' class="btn btn-primary ">{{ __('Add new') }}</a>
            </div>
        </div>
        <div class="panel panel-default" style="margin-top: 20px">    
            <div class="panel-body" style="padding: 0;">
              @if (isset($invitations[0]))
                
                    <table class="table table-responsive table-striped" style="margin-bottom: 0">
                        <thead>
                            <tr>
                                <th>{{__('Id')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Note')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Invitation Link')}}</th>
                                <th>{{__('Actions')}}</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invitations as $invitation)
                                <tr>
                                     <td> {{ $invitation->id }}</td>
                                    <td><a href="mailto:{{ $invitation->email }}">{{ $invitation->email }}</a></td>
                                    <td>{{ $invitation->message }}</td>
                                    <td>{{ $invitation->created_at }}</td>
                                    <td class="word_wrap">
                                        {{ $invitation->getLink() }}
                                    </td>
                                    <td>
                                        <form action="{{route('invitations.destroy',[$invitation->id])}}" method="POST"> 
                                            @method('DELETE') 
                                            @csrf
                                            <button type="submit">Delete</button>               
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                         
                @endif
            </div>
        </div>
    </div>
@endsection