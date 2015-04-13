@extends('layouts.imsmaster')

@section('title')
    <title>IMS | View all Inventory</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-shopping-cart"></span> Art Inventory</h1>
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
                    'status' => 'Status',
                    'year' => 'Year',
                    'title' => 'Title',
                    'category' => 'Category',
                    'subject' => 'Subject',
                    'medium' => 'Medium',
                    'art#'    => 'Art#'),
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
                        link_to_route('ims.arts.index','Art#',['sortBy' => 'id','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','Art#', ['sortBy' => 'id','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'status' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','Status',['sortBy' => 'status','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','Status', ['sortBy' => 'status','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>Artist</th>
                <th>@if ($sortBy == 'year' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','Year',['sortBy' => 'year','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','Year', ['sortBy' => 'year','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'title' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','Title',['sortBy' => 'title','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','Title', ['sortBy' => 'title','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'category' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','Category',['sortBy' => 'category','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','Category', ['sortBy' => 'category','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'subject' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','Subject',['sortBy' => 'subject','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','Subject', ['sortBy' => 'subject','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'medium' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','Medium',['sortBy' => 'medium','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','Medium', ['sortBy' => 'medium','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'height' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','H(in)',['sortBy' => 'height','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','H(in)', ['sortBy' => 'height','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'width' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','W(in)',['sortBy' => 'width','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','W(in)', ['sortBy' => 'width','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'depth' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','D(in)',['sortBy' => 'depth','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','D(in)', ['sortBy' => 'depth','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'price' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','Price (€)',['sortBy' => 'price','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','Price (€)', ['sortBy' => 'price','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'updated_at' && $direction == 'asc')
                        {{
                        link_to_route('ims.arts.index','Last Updated',['sortBy' => 'updated_at','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.arts.index','Last Updated', ['sortBy' => 'updated_at','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ($arts->count())
                @foreach($arts as $art)
                    <tr>
                        <td><img src="/artPictures/{{ $art->picture }}" alt="picture" style="width:50px;height:50px">
                        </td>
                        <td>{{ $art->id }}</td>
                        <td>{{ $art->status }}</td>
                        <td>
                            <a href="{{ URL::to('ims/artists/' .$art->artist->id . '/edit') }}">{{ $art->artist->first_name . " " . $art->artist->second_name}}</a>
                        </td>
                        <td>{{ $art->year }}</td>
                        <td>{{ $art->title }}</td>
                        <td>{{ $art->category }}</td>
                        <td>{{ $art->subject }}</td>
                        <td>{{ $art->medium }}</td>
                        <td>{{ $art->height }}</td>
                        <td>{{ $art->width }}</td>
                        <td>{{ $art->depth }}</td>
                        <?php setlocale(LC_MONETARY, "en_us"); ?>
                        <td>{{ money_format("%!.0i", $art->price)}}</td>
                        <td>{{ date("d-M-y H:i a", strtotime($art->updated_at)) }}</td>
                        <td>
                            <!-- edit this art item -->
                            <a class="btn btn-small btn-info"
                               href="{{ URL::to('ims/arts/' . $art->id . '/edit') }}"><span
                                        class="glyphicon glyphicon-search"></span></a>

                            <!-- show the art item on main website -->
                            <a class="btn btn-small btn-success"
                               href="{{ URL::to('/art/' . $art->category . '/' .$art->id) }}"><span
                                        class="glyphicon glyphicon-globe"></span></a>

                            {{--delete the art item--}}
                            {{ Form::open(['method' => 'delete', 'class' => 'pull-right', 'route' => ['ims.arts.destroy', $art->id]]) }}
                            {{ Form::button('<span class="glyphicon glyphicon-trash"></span>',array('class'=>'btn btn-danger','type'=>'submit'))}}
                            {{ Form::close() }}

                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
                <p>No results match that search !</p>
            @endif
        </table>
        {{ $arts->appends(Request::except('page'))->links() }}
    </div>
@stop
