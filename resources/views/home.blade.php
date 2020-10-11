@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="title"><h1>NosMG</h1></div>

    <div class="row justify-content-center">
        <div class="col-md-8">
             <h3>{{ __('messages.welcome_home') }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <a href="players" class="btn btn-primary button-home">{{ __("Your's Playable Characters") }}</a>
        </div>
    <div class="col-sm-6">
        <a href="{{ route('activities.index') }}" class="btn btn-primary button-home">{{ __('Activities') }}</a>
    </div>
    </div>

    
</div>
@endsection
