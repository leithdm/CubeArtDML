@extends('layouts.imsmaster')

@section('title')
    <title>IMS | Select an item for gallery</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-6 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-camera"></span> Select an item for gallery</h1>
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
                <th>Art#</th>
                <th>Title</th>
                {{--<td>Status</td>--}}
                <th>Category</th>
                <th>Price €</th>
                {{--<th>Subject</th>--}}
                {{--<th>Medium</th>--}}
                <th>Artist</th>
                <th>Picture</th>
                {{--<th>Last Updated</th>--}}
                <th>Select</th>
                <th>Save</th>
            </tr>
            </thead>
            <tbody>
            @foreach($arts as $art)
                <tr>
                    <td>{{ $art->id }}</td>
                    <td>{{ $art->title }}</td>
                    {{--<td>{{ art->status }}</td>--}}
                    <td>{{ $art->category }}</td>
                    <td>{{ $art->price }}</td>
                    {{--<td>{{ $art->subject }}</td>--}}
                    {{--<td>{{ $art->medium }}</td>--}}
                    <td>
                        <a href="{{ URL::to('ims/artists/' .$art->artist->id . '/edit') }}">{{ $art->artist->second_name . ", " . $art->artist->first_name}}</a>
                    </td>
                    <td><img src="/artPictures/{{ $art->picture }}" alt="picture" style="width:75px;height:75px">
                    </td>
                    <td>
                        {{Form::radio('name', 'value');}}
                    </td>
                    {{--<td>{{ date("d-M-y H:i a", strtotime($art->updated_at)) }}</td>--}}
                    <td>
                        <!-- edit this art item -->
                        <a class="btn btn-small btn-info"
                           href="{{ URL::to('ims/arts/' . $art->id . '/edit') }}"><span
                                    class="glyphicon glyphicon-save"></span></a>

                        {{--delete the art item--}}
                        {{--{{ Form::open(['method' => 'delete', 'class' => 'pull-right', 'route' => ['ims.arts.destroy', $art->id]]) }}--}}
                        {{--{{ Form::button('<span class="glyphicon glyphicon-trash"></span>',array('class'=>'btn btn-danger','type'=>'submit'))}}--}}
                        {{--{{ Form::close() }}--}}

                        <!-- show the art item on main website -->
                        {{--<a class="btn btn-small btn-success" href="{{ URL::to('#') }}"><span--}}
                                    {{--class="glyphicon glyphicon-search"></span></a>--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $arts->links() }}
    </div>
@stop
