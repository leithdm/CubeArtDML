@extends('layouts.imsmaster')

@section('title')
    <title>IMS | Create an Artist</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-5 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-plus"></span> add a new Artist</h1>
        <!-- if there are creation errors, they will show here -->
        @if ($errors->has())
            <div class="alert alert-danger">
                {{ HTML::ul($errors->all()) }}
            </div>
        @endif

        {{ Form::open(['route' => 'ims.artists.store', 'files' => true]) }}
        <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::select('title', array('Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Miss.' => 'Miss.', 'Ms.' => 'Ms.', 'Other' => 'Other'), Input::old('title'), array('class' => 'form-control')) }}
        </div>

        <div class="form-group">
            {{ Form::label('first_name', 'First Name') }}
            {{ Form::text('first_name', Input::old('first_name'), array('class' => 'form-control')) }}
            @if ($errors->has('first_name')) <p class="help-block">{{ $errors->first('first_name') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('middle_name', 'Middle Name') }}
            {{ Form::text('middle_name', Input::old('middle_name'), array('class' => 'form-control')) }}
            @if ($errors->has('middle_name')) <p
                    class="help-block">{{ $errors->first('middle_name') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('second_name', 'Surname') }}
            {{ Form::text('second_name', Input::old('second_name'), array('class' => 'form-control')) }}
            @if ($errors->has('second_name')) <p
                    class="help-block">{{ $errors->first('second_name') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('address1', 'Address 1') }}
            {{ Form::text('address1', Input::old('address1'), array('class' => 'form-control')) }}
            @if ($errors->has('address1')) <p class="help-block">{{ $errors->first('address1') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('address2', 'Address 2') }}
            {{ Form::text('address2', Input::old('address2'), array('class' => 'form-control')) }}
            @if ($errors->has('address2')) <p class="help-block">{{ $errors->first('address2') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('address3', 'Address 3') }}
            {{ Form::text('address3', Input::old('address3'), array('class' => 'form-control')) }}
            @if ($errors->has('address3')) <p class="help-block">{{ $errors->first('address3') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('city', 'City') }}
            {{ Form::text('city', Input::old('city'), array('class' => 'form-control')) }}
            @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('country', 'Country') }}
            {{ Form::text('country', Input::old('country'), array('class' => 'form-control')) }}
            @if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('about', 'About') }}
            {{ Form::textarea('about', Input::old('about'), array('class' => 'form-control', 'rows' => 12)) }}
            @if ($errors->has('about')) <p class="help-block">{{ $errors->first('about') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('quote', 'Quote') }}
            {{ Form::textarea('quote', Input::old('quote'), array('class' => 'form-control', 'rows' => 3)) }}
            @if ($errors->has('quote')) <p class="help-block">{{ $errors->first('quote') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email', Input::old('email'), array('class' => 'form-control')) }}
            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('phone1', 'Phone Number 1') }}
            {{ Form::text('phone1', Input::old('phone1'), array('class' => 'form-control')) }}
            @if ($errors->has('phone1')) <p class="help-block">{{ $errors->first('phone1') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('phone2', 'Phone Number 2') }}
            {{ Form::text('phone2', Input::old('phone2'), array('class' => 'form-control')) }}
            @if ($errors->has('phone2')) <p class="help-block">{{ $errors->first('phone2') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('facebook', 'FaceBook URL') }}
            {{ Form::text('facebook', Input::old('facebook'), array('class' => 'form-control')) }}
            @if ($errors->has('facebook')) <p class="help-block">{{ $errors->first('facebook') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('twitter', 'Twitter URL') }}
            {{ Form::text('twitter', Input::old('twitter'), array('class' => 'form-control')) }}
            @if ($errors->has('twitter')) <p class="help-block">{{ $errors->first('twitter') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('pinterest', 'Pinterest URL') }}
            {{ Form::text('pinterest', Input::old('pinterest'), array('class' => 'form-control')) }}
            @if ($errors->has('pinterest')) <p class="help-block">{{ $errors->first('pinterest') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('google', 'Google+ URL') }}
            {{ Form::text('google', Input::old('google'), ['class' => 'form-control']) }}
            @if ($errors->has('google')) <p class="help-block">{{ $errors->first('google') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::label('picture', 'Picture') }}
            {{ Form::file('picture') }}
            @if ($errors->has('picture')) <p class="help-block">{{ $errors->first('picture') }}</p> @endif
        </div>

        <div class="form-group">
            {{ Form::submit('Create the Artist!', ['class' => 'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
    </div>

@stop
