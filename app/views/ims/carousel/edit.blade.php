@extends('layouts.imsmaster')

@section('title')
    <title>IMS | Select an item for gallery</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-pencil"></span> Select an item for position {{$getId->id}}</h1>
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <div class="search-artists">
            <div class="row">
                <div class="col-md-3">
                    {{ Form::open(['method' => 'GET']) }}
                    {{ Form::input('text', 'query', null, ['class' => 'form-control', 'placeholder' => 'Type search query...']) }}
                </div>
                <div class="col-md-4">
                    {{ Form::select('criteria', array(
                    'search' => 'Select search criteria',
                    'status' => 'Status',
                    'title' => 'Title',
                    'category' => 'Category',
                    'art#'    => 'Art#'),
                    Input::old('criteria'),
                    ['class' => 'form-control']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        {{ Form::model($getId, ['method' => 'PUT', 'route' => ['ims.carousel.update', $getId->id]]) }}
        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
                <th>Thumbnail</th>
                <th>Art#</th>
                <th>Status</th>
                <th>Title</th>
                <th>Category</th>
                <th>Price €</th>
                <th>Artist</th>
                <th>Select</th>
                <th>Save</th>
            </tr>
            </thead>
            <tbody>
            @foreach($arts as $art)
                <tr>
                    <td><img src="/artPictures/{{ $art->picture }}" alt="picture" style="width:75px;height:75px"></td>
                    <td>{{ $art->id }}</td>
                    <td>{{ $art->status }}</td>
                    <td>{{ $art->title }}</td>
                    <td>{{ $art->category }}</td>
                    <td>{{ $art->price }}</td>
                    <td>
                        <a href="{{ URL::to('ims/artists/' .$art->artist->id . '/edit') }}">{{ $art->artist->second_name . ", " . $art->artist->first_name}}</a>
                    </td>
                    <td>
                        <div class="form-group">
                            <input type="radio" name="radio" value="{{$art->id}}">
                        </div>

                    </td>
                    {{--<td>{{ date("d-M-y H:i a", strtotime($art->updated_at)) }}</td>--}}
                    <td>

                        <div class="form-group">
                            {{ Form::button('<span class="glyphicon glyphicon-save"></span>', array('class'=>'btn btn-info','type'=>'submit'))}}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $arts->appends(Request::except('page'))->links() }}
        {{ Form::close() }}
    </div>
@stop
