@extends('layouts.imsmaster')

@section('title')
    <title>IMS | Edit Event</title>
@stop

@section('content')
    {{--section for showing artist edit information--}}
    <div class="col-sm-9 col-sm-offset-3 col-md-5 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-pencil"></span> Edit <span
                    style="color:#3c5f98;">{{ $exhibition->title }}</span>
        </h1>
        <!-- if there are creation errors, they will show here -->
        @if ($errors->has())
            <div class="alert alert-danger">
                {{ HTML::ul($errors->all()) }}
            </div>
        @endif

        {{ Form::model($exhibition, ['method' => 'PUT', 'files' => true, 'route' => ['ims.events.update', $exhibition->id]]) }}

        <div class="form-group">
            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', Input::old('title'), array('class' => 'form-control')) }}
                @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
            </div>

            <div class="form-group">
                Date: <span style="color:gray;">{{date("d-M-y H:i a", strtotime($exhibition->date_event))}}</span>
                {{--{{ Form::label('date', 'Date') }}--}}
                {{ Form::text('date', Input::old('date'), array('class' => 'form-control', 'id' => 'datetimepicker' ,'placeholder' => 'Change the event date or time', 'type' => 'input')) }}
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

            {{ Form::submit('Edit the Event!', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}
        </div>
    </div>
    <div class="col-md-4 col-md-offset-1 main">
        <br/><br/><br/>
        <img src="/upload/{{ $exhibition->picture }}" alt="picture" style="width:400px;height:400px">
    </div>

    {{--section for showing art related to artist--}}
    {{--<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">--}}
    {{--<div class="page-header">--}}
    {{--<h1>Art items</h1>--}}
    {{--</div>--}}
    {{--<table class="table table-striped table-bordered table-hover table-condensed">--}}
    {{--<thead>--}}
    {{--<tr>--}}
    {{--<td>Title</td>--}}
    {{--<td>Picture</td>--}}
    {{--<td>Actions</td>--}}
    {{--</tr>--}}
    {{--</thead>--}}
    {{--<tbody>--}}
    {{--@foreach($artist->arts as $art)--}}
    {{--<tr>--}}
    {{--<td>{{ $art->title }}</td>--}}
    {{--<td><img src="/artPictures/{{ $art->picture }}" alt="picture"--}}
    {{--style="width:50px;height:50px"></td>--}}
    {{--<td>--}}
    {{--<!-- edit this artist (uses the edit method found at GET ims/artists/{id}/edit -->--}}
    {{--<a class="btn btn-small btn-info"--}}
    {{--href="{{ URL::to('ims/arts/' . $art->id . '/edit') }}"><span--}}
    {{--class="glyphicon glyphicon-pencil"></span></a>--}}

    {{--view the art item on main website--}}
    {{--<a class="btn btn-small btn-success"--}}
    {{--href="{{ URL::to('#')}}"><span--}}
    {{--class="glyphicon glyphicon-search"></span></a>--}}


    {{--{{ Form::open(['method' => 'delete', 'class' => 'pull-right', 'route' => ['ims.arts.destroy', $art->id]]) }}--}}
    {{--{{ Form::button('<span class="glyphicon glyphicon-trash"></span>',array('class'=>'btn btn-danger','type'=>'submit'))}}--}}
    {{--{{ Form::close() }}--}}
    {{--</td>--}}
    {{--</tr>--}}
    {{--@endforeach--}}
    {{--</tbody>--}}
    {{--</table>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
@stop
