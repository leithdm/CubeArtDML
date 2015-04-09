@extends('layouts.imsmaster')

@section('title')
    <title>Create an Order</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-5 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-plus"></span> create a new PO</h1>

        @if ($errors->has())
            <div class="alert alert-danger">
                {{ HTML::ul($errors->all()) }}
            </div>
        @endif

        @if ($arts->count())
            <div class="form-group">
                <div class="search-artists">
                    <div class="row">
                        <div class="col-md-4">
                            {{ Form::open(['method' => 'GET']) }}
                            {{ Form::input('text', 'query', null, ['class' => 'form-control', 'placeholder' => 'Search...']) }}
                        </div>

                        <div class="col-md-4">
                            {{ Form::select('criteria', array(
                            'search' => 'Choose search',
                            'title' => 'Title',
                            'category' => 'Category',
                            'art#'    => 'Art#'),
                            Input::old('criteria'),
                            ['class' => 'form-control']) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p>No results match that search !</p>
        @endif

        {{ Form::open(['route' => 'ims.orders.store', 'files' => true]) }}
        <div class="form-group">
            {{ Form::label('item1', 'Select the art item') }}

            <table class="table table-striped table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <th>@if ($sortBy == 'id' && $direction == 'asc')
                            {{
                            link_to_route('ims.orders.create','Art#',['sortBy' => 'id','direction' => 'desc'])
                        }}
                        @else {{
                        link_to_route('ims.orders.create','Art#', ['sortBy' => 'id','direction' => 'asc'])
                    }}
                        @endif
                    </th>
                    <th>Picture</th>
                    <th>@if ($sortBy == 'title' && $direction == 'asc')
                            {{
                            link_to_route('ims.orders.create','Title',['sortBy' => 'title','direction' => 'desc'])
                        }}
                        @else {{
                        link_to_route('ims.orders.create','Title', ['sortBy' => 'title','direction' => 'asc'])
                    }}
                        @endif
                    </th>
                    <th>@if ($sortBy == 'category' && $direction == 'asc')
                            {{
                            link_to_route('ims.orders.create','Category',['sortBy' => 'category','direction' => 'desc'])
                        }}
                        @else {{
                        link_to_route('ims.orders.create','Category', ['sortBy' => 'category','direction' => 'asc'])
                    }}
                        @endif
                    </th>
                    <th>@if ($sortBy == 'price' && $direction == 'asc')
                            {{
                            link_to_route('ims.orders.create','Price (€)',['sortBy' => 'price','direction' => 'desc'])
                        }}
                        @else {{
                        link_to_route('ims.orders.create','Price (€)', ['sortBy' => 'price','direction' => 'asc'])
                    }}
                        @endif
                    </th>
                    <th>Artist</th>
                    <th>Select</th>
                </tr>
                </thead>
                <tbody>
                @foreach($arts as $art)
                    <tr>
                        <td>{{ $art->id }}</td>
                        <td>
                            <a href="{{ URL::to('ims/arts/' .$art->id . '/edit') }}"><img
                                        src="/artPictures/{{ $art->picture }}" alt="picture"
                                        style="width:50px;height:50px"></a>
                        </td>
                        <td>{{ $art->title }}</td>
                        <td>{{ $art->category }}</td>
                        <?php setlocale(LC_MONETARY, "en_us"); ?>
                        <td>{{ money_format("%!.0i", $art->price)}}</td>
                        <td>
                            <a href="{{ URL::to('ims/artists/' .$art->artist->id . '/edit') }}">{{ $art->artist->first_name . " " . $art->artist->second_name}}</a>
                        </td>
                        <td>
                            <div class="form-group">
                                <input type="radio" name="artItem" value="{{$art->id}}">
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        {{ $arts->appends(Request::except('page'))->links() }}

        <div class="row">
            <div class="col-md-7">
                <div class="form-group">
                    {{ Form::label('customer', 'Customer') }}
                    <br/>
                    {{ Form::select('customer', $customers, Input::old('customer'), array('id' => 'customer', 'class' => 'form-control')) }}
                    @if ($errors->has('customer')) <p class="help-block">{{ $errors->first('customer') }}</p> @endif
                </div>

                <div class="form-group">
                    {{ Form::label('sellingPrice', 'Actual Selling Price (€)') }}
                    {{ Form::text('sellingPrice', Input::old('sellingPrice'), array('class' => 'form-control')) }}
                    @if ($errors->has('sellingPrice')) <p
                            class="help-block">{{ $errors->first('sellingPrice') }}</p> @endif
                </div>

                <div class="form-group">
                    {{ Form::submit('Create the Purchase Order!', array('class' => 'btn btn-primary')) }}
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>

    {{--<script>$('.selectpicker').selectpicker();</script>--}}
    {{--<script>$(document).ready(function() {--}}
    {{--$('.selectpicker').selectpicker({--}}
    {{--style: 'btn-default',--}}
    {{--size: false--}}
    {{--});--}}
    {{--});</script>--}}
@stop