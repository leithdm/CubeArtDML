@extends('layouts.main')

@section('title')
  <title>Cube Art Studio | Collage</title>
@stop

@section('content')
  {{--main content--}}
  <div class="container">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="viewpage-query">
            <p id="new-artwork-header">EVENTS</p>

            <p id="new-artwork-tag">Stay informed about upcoming and past exhibitions featuring CubeArt artists.
              In addition to being a leading online art gallery, we collaborate with brick-and-mortar galleries
              and various other organizations to exhibit the work of some of our most promising artists in shows around the globe.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="search-artists">
      <div class="row">
        <div class="col-md-3">
          {{ Form::open(['method' => 'GET']) }}
          {{ Form::select('query', array(
          'search' => 'Search...',
          'latest' => 'Latest',
          'oldest' => 'Older'),
          Input::old('select'), array('class' => 'form-control')) }}
        </div>
        <div class="col-md-1">
          {{ Form::button('<span class="glyphicon glyphicon-search"></span>', array('class'=>'btn btn-info','type'=>'submit'))}}
          {{ Form::close() }}
        </div>
      </div>
    </div>

    <div>
      <div class="container">
        <div class="row">
          <hr/>
          @foreach($exhibitions as $exhibition)
            <div class="container">
              <div class="art-details-picture-sidebar">
                <div class="row">
                  <div class="col-md-6">
                    <img src="/upload/{{ $exhibition->picture }}" alt="picture" style="width:500px;height:500px">
                  </div>
                  <div class="col-md-6">
                    <div class="art-details-rightsidebar">
                      <h2>{{ "'". $exhibition->title ."'" }}</h2>
                      <br/>
                      <h4>{{ date("d-M-y H:i a", strtotime($exhibition->date_event)) }}</h4>
                      <h5>{{$exhibition->about}}</h5>
                      <br/>
                    </div>
                  </div>
                </div>
              </div>
              <div id="gallery-break-events"></div>
            </div>
          @endforeach
          {{ $exhibitions->appends(Request::except('page'))->links() }}
        </div>
      </div>
    </div>
  </div>
@stop







