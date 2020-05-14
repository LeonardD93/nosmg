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
    
    <!--<div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                

                <div class="card-body">
                    <h3>Benvenuto su NosMg la piattaforma di organizzazione eventi su giochi online.</h3>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            sono qua
                             
                        </div>
                    @endif

                  
                </div>
            </div>
        </div>
    </div>-->
</div>
@endsection
