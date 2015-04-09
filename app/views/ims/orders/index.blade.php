@extends('layouts.imsmaster')

@section('title')
    <title>IMS | View all Orders</title>
@stop

@section('content')
    <div class="col-sm-9 col-sm-offset-3 col-md-7 col-md-offset-1 main">
        <h1 class="page-header"><span class="glyphicon glyphicon-euro"></span> Purchase Orders</h1>
        <!-- will be used to show any messages -->
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif

        <table class="table table-striped table-bordered table-hover table-condensed">
            <thead>
            <tr>
                <th>Art Item</th>
                <th>P.O#</th>
                <th>Art#</th>
                <th>Customer</th>
                <th>Total Cost (€)</th>
                <th>Date of P.O</th>
                <th>Last Updated</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td><img src="/artPictures/{{ Art::find($order->arts_id)->picture }}" alt="picture" style="width:50px;height:50px"></td>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->arts_id }}</td>
                        <td><a href="{{ URL::to('ims/customers/' .$order->customer->id . '/edit') }}">{{ $order->customer->first_name . " " . $order->customer->second_name}}</a>
                    </td>
                    <?php setlocale(LC_MONETARY, "en_us"); ?>
                    <td>{{ money_format("%!.0i", $order->sellingPrice) }}</td>
                    <td>{{ date("d-M-y H:i a", strtotime($order->created_at)) }}</td>
                    <td>{{ date("d-M-y H:i a", strtotime($order->updated_at)) }}</td>
                    <td>
                        <!-- edit-->
                        <a class="btn btn-small btn-info"
                           href="{{ URL::to('ims/orders/' . $order->id . '/edit') }}"><span
                                    class="glyphicon glyphicon-search"></span></a>

                        {{--delete the art item--}}
                        {{ Form::open(['method' => 'delete', 'class' => 'pull-right', 'route' => ['ims.orders.destroy', $order->id]]) }}
                        {{ Form::button('<span class="glyphicon glyphicon-trash"></span>',array('class'=>'btn btn-danger','type'=>'submit'))}}
                        {{ Form::close() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@stop
