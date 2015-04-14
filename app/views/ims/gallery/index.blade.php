@extends('layouts.imsmaster')

@section('title')
  <title>IMS | Art Gallery</title>
@stop

@section('content')
  <div class="col-md-5 col-md-offset-1 main">
    <h1 class="page-header"><span class="glyphicon glyphicon-camera"></span> Current Art Gallery</h1>
    <!-- will be used to show any messages -->
    @if (Session::has('message'))
      <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    @foreach($galleryArt as $gallery)
      {{--{{$gallery->id}}--}}
      <div class="col-md-4">
        <div class="galleryart">
          <div class="gallerythumbnail">
            <a href="{{ URL::to('ims/gallery/' . $gallery->id . '/edit') }}"><img
                  src="/artPictures/{{ $gallery->arts->picture }}"
                  alt="picture{{$gallery->id }}"
                  style="width:150px;height:150px"></a>
          </div>
          <p id=gallery-thumbnail-title>{{ "'". $gallery->arts->title. "'"}}</p>

          <p id=gallery-thumbnail-artist>{{ 'Art#'. $gallery->arts->id}}</p>

          <a href="{{ URL::to('artist/' . $gallery->arts->artist_id) }}"><p
                id=gallery-thumbnail-artist>{{$gallery->arts->artist->first_name . " " .  $gallery->arts->artist->second_name }}</p>
          </a>
        </div>
        <div id="gallery-break"></div>
      </div>
    @endforeach
  </div>
  </div>
@stop
