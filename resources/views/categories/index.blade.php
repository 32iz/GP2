@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Categories Management') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
                                <a class="btn btn-success" href="{{ route('subcategories.create') }}"> Create New SubCategory</a>
                            </div>
                        </div>
                    </div>
                    <br>
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
                                <th class="table-secondary" width="350px">Action</th>
                            </tr>
                        @foreach ($data as $key => $category)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $category->name }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('subcategories.display',$category->id) }}">SubCategories</a>
                                    <a class="btn btn-info" href="{{ route('categories.show',$category->id) }}">Show</a>
                                    <a class="btn btn-primary" href="{{ route('categories.edit',$category->id) }}">Edit</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id],'style'=>'display:inline']) !!}
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