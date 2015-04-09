@extends('layouts.main')

@section('title')
    <title>Login Page</title>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="container-adminpadding">
                    <div class="jumbotron">
                        <h1>Login to IMS</h1>
                        @if ($errors->has())
                            <div class="alert alert-danger">
                                {{ HTML::ul($errors->all()) }}
                            </div>
                        @endif

                        @if (Session::has('flash_message'))
                            <div class="alert alert-danger">{{ Session::get('flash_message') }}</div>
                        @endif
                        {{ Form::open(array('route' => 'sessions.store')) }}

                        <div class="form-group">
                            {{ Form::label('username', 'Username') }}
                            {{ Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
                            @if ($errors->has('username')) <p
                                    class="help-block">{{ $errors->first('username') }}</p> @endif
                        </div>

                        <div class="form-group">
                            {{ Form::label('password', 'Password') }}
                            {{ Form::password('password', array('class' => 'form-control')) }}
                            @if ($errors->has('password')) <p
                                    class="help-block">{{ $errors->first('password') }}</p> @endif
                        </div>

                        <div class="form-group">
                            {{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop