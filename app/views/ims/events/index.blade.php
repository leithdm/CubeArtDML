@extends('layouts.imsmaster')

@section('title')
    <title>IMS | View all Events</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-9 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-calendar"></span> Events</h1>

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
                    'title' => 'Title',
                    'about' => 'About',
                    'event#' => 'Event#'),
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
                        link_to_route('ims.events.index','Event#',['sortBy' => 'id','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.events.index','Event#', ['sortBy' => 'id','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'title' && $direction == 'asc')
                        {{
                        link_to_route('ims.events.index','Title',['sortBy' => 'title','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.events.index','Title', ['sortBy' => 'title','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'date_event' && $direction == 'asc')
                        {{
                        link_to_route('ims.events.index','Date of Event',['sortBy' => 'date_event','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.events.index','Date of Event', ['sortBy' => 'date_event','direction' => 'asc'])
                    }}
                    @endif
                </th>
                {{--<th>@if ($sortBy == 'about' && $direction == 'asc')--}}
                        {{--{{--}}
                        {{--link_to_route('ims.events.index','About',['sortBy' => 'about','direction' => 'desc'])--}}
                    {{--}}--}}
                    {{--@else {{--}}
                        {{--link_to_route('ims.events.index','About', ['sortBy' => 'about','direction' => 'asc'])--}}
                    {{--}}--}}
                    {{--@endif--}}
                {{--</th>--}}
                <th>@if ($sortBy == 'updated_at' && $direction == 'asc')
                        {{
                        link_to_route('ims.events.index','Last Updated',['sortBy' => 'updated_at','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.events.index','Last Updated', ['sortBy' => 'updated_at','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ($events->count())
                @foreach($events as $event)
                    <tr>
                        <td><img src="/upload/{{ $event->picture }}" alt="picture"
                                 style="width:50px;height:50px;">
                        </td>
                        <td>{{ $event->id }}</td>
                        <td>{{ $event->title }}</td>
                        <td>{{ date("d-M-Y H:i a", strtotime($event->date_event)) }}</td>
                        {{--<td>{{ $event->about }}</td>--}}
                        <td>{{ date("d-M-y H:i a", strtotime($event->updated_at)) }}</td>
                        <!-- we will also add show, edit, and delete buttons -->
                        <td>
                            <!-- edit this artist (uses the edit method found at GET ims/artists/{id}/edit -->
                            <a class="btn btn-small btn-info"
                               href="{{ URL::to('ims/events/' . $event->id . '/edit') }}"><span
                                        class="glyphicon glyphicon-pencil"></span></a>

                            <!-- show the artist (uses the show method found at GET ims/artists/{id} -->
                            <a class="btn btn-small btn-success"
                               href="{{ URL::to('#') }}"><span
                                        class="glyphicon glyphicon-search"></span></a>

                            {{--<!-- add an item of art (uses the edit method found at GET ims/artists/{id}/edit -->--}}
                            {{--<a class="btn btn-small btn-warning"--}}
                            {{--href="{{ URL::to('ims/artists/create') }}"><span class="glyphicon glyphicon-plus"></span></a>--}}

                            <!-- delete the artist (uses the destroy method DESTROY ims/artists/{id} -->
                            {{ Form::open(['method' => 'delete', 'class' => 'pull-right', 'route' => ['ims.events.destroy', $event->id]]) }}
                            {{ Form::button('<span class="glyphicon glyphicon-trash"></span>', array('class'=>'btn btn-danger','type'=>'submit'))}}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
                <p>No events match that search !</p>
            @endif
        </table>
        {{ $events->appends(Request::except('page'))->links() }}
    </div>
    </div>
    </div>
@stop
