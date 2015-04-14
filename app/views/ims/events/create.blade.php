@extends('layouts.imsmaster')

@section('title')
    <title>IMS | Create an Event</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-5 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-plus"></span> add a new Event</h1>
        <!-- if there are creation errors, they will show here -->
        @if ($errors->has())
            <div class="alert alert-danger">
                {{ HTML::ul($errors->all()) }}
            </div>
        @endif

        {{ Form::open(['route' => 'ims.events.store', 'files' => true]) }}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
            @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('date', 'Date') }}
            {{ Form::text('date', '', array('class' => 'form-control', 'id' => 'datetimepicker' ,'placeholder' => 'Pick an event date', 'type' => 'input')) }}
            @if ($errors->has('date')) <p class="help-block">{{ $errors->first('date') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('about', 'About') }}
            {{ Form::textarea('about', Input::old('about'), array('class' => 'form-control', 'rows' => 5)) }}
            @if ($errors->has('about')) <p class="help-block">{{ $errors->first('about') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('picture', 'Picture') }}
            {{ Form::file('picture') }}
            @if ($errors->has('picture')) <p class="help-block">{{ $errors->first('picture') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::submit('Create the Event!', array('class' => 'btn btn-primary')) }}
        </div>

        {{ Form::close() }}
    </div>
    </div>
    </div>

@stop
