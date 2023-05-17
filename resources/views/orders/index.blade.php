@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Orders Management') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                        <!--  <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('orders.create') }}"> Create New Order</a>
                            </div> -->
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    <div class='table-responsive'>
                        <table class="table table-bordered text-center table-hover">
                            <tr>
                                <th class="table-secondary">Order ID</th>
                                <th class="table-secondary">Subcategory ID</th>
                                <th class="table-secondary">User ID</th>
                                <th class="table-secondary" width="160px">Action</th>
                            </tr>
                        @foreach ($data as $key => $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->subcategory_id }}</td>
                                <td>{{ $order->user_id }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('orders.show',$order->id) }}">Show</a>
                                <!-- <a class="btn btn-primary" href="{{ route('orders.edit',$order->id) }}">Edit</a> -->
                                        {!! Form::open(['method' => 'DELETE','route' => ['orders.destroy', $order->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection