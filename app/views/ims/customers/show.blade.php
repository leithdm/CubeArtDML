@extends('layouts.imsmaster')

@section('title')
    <title>IMS | View Customer Details</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-1 main">
        <h1 class="page-header">Showing <span
                    style="color:#3c5f98;">{{ $artist->first_name . " " . $artist->second_name }}</span>
        </h1>

        <div class="jumbotron text-center">
            <p>
                <strong>Email:</strong> {{ $artist->email }}<br>
                <strong>About:</strong> {{ $artist->about }}
            </p>
        </div>
        <div>
            <img src="/upload/{{ $artist->picture }}" alt="picture" style="width:200px;height:200px">
        </div>

        <div>
            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <td>Title</td>
                    <td>Picture</td>
                    <td>Actions</td>
                </tr>
                </thead>
                <tbody>
                <h2>Art Items</h2>
                @foreach($artist->arts as $art)
                    <tr>
                        <td>{{ $art->title }}</td>
                        <td><img src="/artPictures/{{ $art->picture }}" alt="picture"
                                 style="width:50px;height:50px"></td>
                        <td>
                            {{--view the art item on main website--}}
                            <a class="btn btn-small btn-success"
                               href="{{ URL::to('#')}}"><span
                                        class="glyphicon glyphicon-search"></span></a>
                            <!-- edit this artist (uses the edit method found at GET ims/artists/{id}/edit -->
                            <a class="btn btn-small btn-info"
                               href="{{ URL::to('ims/arts/' . $art->id . '/edit') }}"><span
                                        class="glyphicon glyphicon-pencil"></span></a>

                            {{ Form::open(['method' => 'delete', 'class' => 'pull-right', 'route' => ['ims.arts.destroy', $art->id]]) }}
                            {{ Form::button('<span class="glyphicon glyphicon-trash"></span>',array('class'=>'btn btn-danger','type'=>'submit'))}}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </div>
@stop
