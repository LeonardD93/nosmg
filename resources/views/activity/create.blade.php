
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <a href='{{route('activities.create')}}' class="btn btn-primary ">{{ __('Add new') }}</a>
        </div>
    </div>
    
</div>
@endsection