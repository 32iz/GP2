@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Stores Management') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('stores.create') }}"> Create New Store</a>
                                <br><br>
                            </div>
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
                                <th class="table-secondary">No</th>
                                <th class="table-secondary">Name</th>
                                <th class="table-secondary">Email</th>
                                <th class="table-secondary" width="10px">Status</th>
                                <th class="table-secondary" width="230px">Action</th>
                            </tr>
                        @foreach ($data as $key => $store)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $store->name }}</td>
                                <td>{{ $store->email }}</td>
                                <td class="text-center">
                                    @if($store->status == "0")
                                        <span class="badge rounded-pill bg-dark">Not Approved</span>
                                    @else
                                        <span class="badge rounded-pill bg-success">Approved</span>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('stores.show',$store->id) }}">Show</a>
                                    <a class="btn btn-primary" href="{{ route('stores.edit',$store->id) }}">Edit</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['stores.destroy', $store->id],'style'=>'display:inline']) !!}
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