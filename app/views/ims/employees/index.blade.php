@extends('layouts.imsmaster')

@section('title')
    <title>IMS | View all Staff Members</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-11 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-user"></span> Staff Members</h1>

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
                    'employee#' => 'Employee#'),
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
                        link_to_route('ims.employees.index','Employee#',['sortBy' => 'id','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.employees.index','Employee#', ['sortBy' => 'id','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'first_name' && $direction == 'asc')
                        {{
                        link_to_route('ims.employees.index','First Name',['sortBy' => 'first_name','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.employees.index','First Name', ['sortBy' => 'first_name','direction' => 'asc'])
                    }}
                    @endif
                </th>
                <th>@if ($sortBy == 'second_name' && $direction == 'asc')
                        {{
                        link_to_route('ims.employees.index','Last Name',['sortBy' => 'second_name','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.employees.index','Last Name', ['sortBy' => 'second_name','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'city' && $direction == 'asc')
                        {{
                        link_to_route('ims.employees.index','City',['sortBy' => 'city','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.employees.index','City', ['sortBy' => 'city','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'country' && $direction == 'asc')
                        {{
                        link_to_route('ims.employees.index','Country',['sortBy' => 'country','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.employees.index','Country', ['sortBy' => 'country','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'email' && $direction == 'asc')
                        {{
                        link_to_route('ims.employees.index','Email',['sortBy' => 'email','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.employees.index','Email', ['sortBy' => 'email','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'phone1' && $direction == 'asc')
                        {{
                        link_to_route('ims.employees.index','Phone#1',['sortBy' => 'phone1','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.employees.index','Phone#1', ['sortBy' => 'phone1','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>@if ($sortBy == 'updated_at' && $direction == 'asc')
                        {{
                        link_to_route('ims.employees.index','Last Updated',['sortBy' => 'updated_at','direction' => 'desc'])
                    }}
                    @else {{
                        link_to_route('ims.employees.index','Last Updated', ['sortBy' => 'updated_at','direction' => 'asc'])
                    }}
                    @endif</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @if ($employees->count())
                @foreach($employees as $employee)
                    <tr>
                        <td><img class="img-circle" src="/upload/{{ $employee->picture }}" alt="picture"
                                 style="width:50px;height:50px;">
                        </td>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->first_name }}</td>
                        <td>{{ $employee->second_name }}</td>
                        <td>{{ $employee->city }}</td>
                        <td>{{ $employee->country }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->phone1 }}</td>
                        <td>{{ date("d-M-y H:i a", strtotime($employee->updated_at)) }}</td>
                        <!-- we will also add show, edit, and delete buttons -->
                        <td>
                            <!-- edit this artist (uses the edit method found at GET ims/artists/{id}/edit -->
                            <a class="btn btn-small btn-info"
                               href="{{ URL::to('ims/employees/' . $employee->id . '/edit') }}"><span
                                        class="glyphicon glyphicon-search"></span></a>

                            <!-- show the artist (uses the show method found at GET ims/artists/{id} -->
                            {{--<a class="btn btn-small btn-success"--}}
                               {{--href="{{ URL::to('#') }}"><span--}}
                                        {{--class="glyphicon glyphicon-globe"></span></a>--}}

                            {{--<!-- add an item of art (uses the edit method found at GET ims/artists/{id}/edit -->--}}
                            {{--<a class="btn btn-small btn-warning"--}}
                            {{--href="{{ URL::to('ims/artists/create') }}"><span class="glyphicon glyphicon-plus"></span></a>--}}

                            <!-- delete the artist (uses the destroy method DESTROY ims/artists/{id} -->
                            {{ Form::open(['method' => 'delete', 'class' => 'pull-right', 'route' => ['ims.employees.destroy', $employee->id]]) }}
                            {{ Form::button('<span class="glyphicon glyphicon-trash"></span>', array('class'=>'btn btn-danger','type'=>'submit'))}}
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            @else
                <p>No Last Names matched that search !</p>
            @endif
        </table>
        {{ $employees->appends(Request::except('page'))->links() }}
    </div>
    </div>
    </div>
@stop
