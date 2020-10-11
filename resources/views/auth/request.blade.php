@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h1>{{__('Requesting Invitation')}}</h1>
                    </div>

                    <div class="panel-body">
                        <p>{{ config('app.name') }} {{__('is a closed community. You must have an invitation link to register. You can request your link below.')}}</p>

                        <form class="form-horizontal" method="POST" action="{{ route('invitations.store') }}" >
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">{{__('E-Mail Address')}}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                 <label for="message" class="col-md-4 control-label">{{__('Leave a message for this request') }}</label>
                                  <div class="col-md-6">
                                      <input id="message" type="text" class="form-control" name="message" >
                                  </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{__('Request An Invitation')}}
                                    </button>

                                    <a class="btn btn-link" href="{{ route('login') }}">
                                        {{__('Already Have An Account?')}}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
