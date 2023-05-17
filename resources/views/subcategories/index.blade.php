@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('SubCategories Management') }}</div>

                <div class="card-body">
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
                                <th class="table-secondary" width="230px">Action</th>
                            </tr>
                        @foreach ($subcategories as $key => $subcategory)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $subcategory->name }}</td>
                                <td>
                                    <a class="btn btn-info" href="{{ route('subcategories.show',$subcategory->id) }}">Show</a>
                                    <a class="btn btn-primary" href="{{ route('subcategories.edit',$subcategory->id) }}">Edit</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['subcategories.destroy', $subcategory->id],'style'=>'display:inline']) !!}
                                            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-right">
                                <a class="btn btn-danger" href="{{ route('categories.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection