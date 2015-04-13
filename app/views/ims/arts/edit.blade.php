@extends('layouts.imsmaster')

@section('title')
    <title>Edit the Art Item</title>
@stop

@section('content')
    <div class="row">
        <div class="col-sm-9 col-sm-offset-3 col-md-4 col-md-offset-1 main">
            <h1 class="page-header"><span class="glyphicon glyphicon-pencil"></span> Edit <span
                        style="color:#3c5f98;">{{ $art->title }}</span></h1>

            @if ($errors->has())
                <div class="alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            @endif

            Artist: <span style="color:gray;">{{$art->artist->second_name . " , " . $art->artist->first_name}}</span>

            {{ Form::model($art, ['method' => 'PUT', 'files' => true, 'route' => ['ims.arts.update', $art->id]]) }}
            <div class="form-group">
                {{ Form::select('artist', $artists, null, array('class' => 'form-control')) }}
                @if ($errors->has('artist')) <p class="help-block">{{ $errors->first('artist') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('status', 'Status') }}
                {{ Form::select('status', array('Available' => 'Available', 'Sold' => 'Sold', 'Loaned Out' => 'Loaned Out'), Input::old('status'), array('class' => 'form-control')) }}
                @if ($errors->has('status')) <p class="help-block">{{ $errors->first('status') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('category', 'Category') }}
                {{ Form::select('category', array('Painting' => 'Painting', 'Photography' => 'Photography', 'Drawing' => 'Drawing', 'Sculpture' => 'Sculpture', 'Collage' => 'Collage'), Input::old('category'), array('class' => 'form-control')) }}
                @if ($errors->has('category')) <p class="help-block">{{ $errors->first('category') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('year', 'Year') }}
                {{ Form::selectYear('year',date('Y'), 1850, Input::old('year'), array('class' => 'form-control')) }}
                @if ($errors->has('year')) <p class="help-block">{{ $errors->first('year') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('title', 'Title') }}
                {{ Form::text('title', Input::old('first_name'), array('class' => 'form-control')) }}
                @if ($errors->has('title')) <p class="help-block">{{ $errors->first('title') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('subject', 'Subject') }}
                {{ Form::text('subject', Input::old('subject'), array('class' => 'form-control')) }}
                @if ($errors->has('subject')) <p class="help-block">{{ $errors->first('subject') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('medium', 'Medium') }}
                {{ Form::text('medium', Input::old('medium'), array('class' => 'form-control')) }}
                @if ($errors->has('medium')) <p class="help-block">{{ $errors->first('medium') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('height', 'Height') }}
                {{ Form::text('height', Input::old('height'), array('class' => 'form-control')) }}
                @if ($errors->has('height')) <p class="help-block">{{ $errors->first('height') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('width', 'Width') }}
                {{ Form::text('width', Input::old('width'), array('class' => 'form-control')) }}
                @if ($errors->has('width')) <p class="help-block">{{ $errors->first('width') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('depth', 'Depth') }}
                {{ Form::text('depth', Input::old('depth'), array('class' => 'form-control')) }}
                @if ($errors->has('depth')) <p class="help-block">{{ $errors->first('depth') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('price', 'Price (€)') }}
                {{ Form::text('price', Input::old('price'), array('class' => 'form-control')) }}
                @if ($errors->has('price')) <p class="help-block">{{ $errors->first('price') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('descriptionLabel', 'Description') }}
                {{ Form::textarea('details', Input::old('details'), array('class' => 'form-control' , 'rows' => 10)) }}
                @if ($errors->has('details')) <p
                        class="help-block">{{ $errors->first('details') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::label('picture', 'Picture') }}
                {{ Form::file('picture') }}
                @if ($errors->has('picture')) <p class="help-block">{{ $errors->first('picture') }}</p> @endif
            </div>

            <div class="form-group">
                {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
            </div>

            {{ Form::close() }}
        </div>

        <div class="col-md-4 col-md-offset-1 main">
            <br/><br/><br/>
                <img src="/artPictures/{{ $art->picture }}" alt="picture" style="width:400px;height:400px">
        </div>
    </div>
@stop