@extends('layouts.imsmaster')

@section('title')
    <title>IMS | View Art Details</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-1 main">
        <h1 class="page-header">Showing <span style="color:#3c5f98;">{{ $art->title  }}</span></h1>

        <div class="jumbotron text-center">
            <p>
                <strong>Category:</strong> {{ $art->category }}<br>
                <strong>Price:</strong> {{ $art->price }}
            </p>
        </div>
        <div>
            <img src="/artPictures/{{ $art->picture }}" alt="picture" style="width:200px;height:200px">
        </div>
    </div>
    </div>
    </div>
@stop
