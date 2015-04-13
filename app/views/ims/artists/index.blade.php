@extends('layouts.imsmaster')

@section('title')
    <title>IMS | View all Artists</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-1 main">

        <h1 class="page-header"><span class="glyphicon glyphicon-tint"></span> Artists</h1>
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <div class="search-artists">
            <div class="row">
                <div class="col-md-2">
                    {{ Form::open(['method' => 'GET']) }}
                    {{ Form::input('text', 'query', null, ['class' => 'form-control', 'placeholder' => 'Type search query...']) }}
                </div>
                <div class="col-md-2">
                    {{ Form::select('criteria', array(
                    'search' => 'Select search criteria',
                    'first_name' => 'First Name',
                    'second_name' => 'Last Name',
                    'city' => 'City',
                    'country' => 'Country',
                    'artist#' => 'Artist#'),
                    Input::old('criteria'),
                    ['class' => 'form-control']) }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
                <th>Thumbnail</th>
                <th>@if ($sortBy == 'id' && $direction == 'asc')
                        {{
                        link_to_route('ims.artists.index','Artist#',['sortBy' => 'id','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.artists.index','Artist#', ['sortBy' => 'id','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'first_name' && $direction == 'asc')
                        {{
                        link_to_route('ims.artists.index','First Name',['sortBy' => 'first_name','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.artists.index','First Name', ['sortBy' => 'first_name','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'second_name' && $direction == 'asc')
                        {{
                        link_to_route('ims.artists.index','Last Name',['sortBy' => 'second_name','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.artists.index','Last Name', ['sortBy' => 'second_name','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'city' && $direction == 'asc')
                        {{
                        link_to_route('ims.artists.index','City',['sortBy' => 'city','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.artists.index','City', ['sortBy' => 'city','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'country' && $direction == 'asc')
                        {{
                        link_to_route('ims.artists.index','Country',['sortBy' => 'country','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.artists.index','Country', ['sortBy' => 'country','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'email' && $direction == 'asc')
                        {{
                        link_to_route('ims.artists.index','Email',['sortBy' => 'email','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.artists.index','Email', ['sortBy' => 'email','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'phone1' && $direction == 'asc')
                        {{
                        link_to_route('ims.artists.index','Phone#1',['sortBy' => 'phone1','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.artists.index','Phone#1', ['sortBy' => 'phone1','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'updated_at' && $direction == 'asc')
                        {{
                        link_to_route('ims.artists.index','Last Updated',['sortBy' => 'updated_at','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.artists.index','Last Updated', ['sortBy' => 'updated_at','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ($artists->count())
                @foreach($artists as $artist)
                    <tr>
                        <td><img class="img-circle" src="/upload/{{ $artist->picture }}" alt="picture"
                                 style="width:50px;height:50px;">
                        </td>
                        <td>{{ $artist->id }}</td>
                        <td>{{ $artist->first_name }}</td>
                        <td>{{ $artist->second_name }}</td>
                        <td>{{ $artist->city }}</td>
                        <td>{{ $artist->country }}</td>
                        <td>{{ $artist->email }}</td>
                        <td>{{ $artist->phone1 }}</td>
                        <td>{{ date("d-M-y H:i a", strtotime($artist->updated_at)) }}</td>
                        <!-- we will also add show, edit, and delete buttons -->
                        <td>
                            <!-- edit this artist (uses the edit method found at GET ims/artists/{id}/edit -->
                            <a class="btn btn-small btn-info"
                               href="{{ URL::to('ims/artists/' . $artist->id . '/edit') }}"><span
                                        class="glyphicon glyphicon-search"></span></a>

                            <!-- show the artist (uses the show method found at GET ims/artists/{id} -->
                            <a class="btn btn-small btn-success"
                               href="{{ URL::to('artist/' .$artist->id) }}"><span
                                        class="glyphicon glyphicon-globe"></span></a>

                            <!-- delete the artist (uses the destroy method DESTROY ims/artists/{id} -->
                            {{ Form::open(['method' => 'delete', 'class' => 'pull-right', 'route' => ['ims.artists.destroy', $artist->id]]) }}
                            {{ Form::button('<span class="glyphicon glyphicon-trash"></span>', array('class'=>'btn btn-danger','type'=>'submit'))}}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
                <p>No results match that search !</p>
            @endif
        </table>
        {{ $artists->appends(Request::except('page'))->links() }}
    </div>
    </div>
@stop
