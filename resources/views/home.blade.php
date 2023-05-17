@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow ">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <!-- {{ __('You are logged in!') }} -->
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class='table-responsive'>
                        <table style="" class="table">
                            <tr>
                                <th style="width:50%" class="fst-italic text-primary align-middle">
                                    <div style="font-size: 3vw;" class="text-center">
                                        Choose <br /> from these <br /> Categories:
                                    </div>
                                </th>
                                <th style="width:50%" class="align-middle">
                                    <div class="d-grid gap-3 mx-auto">
                                        @foreach ($data as $key => $category)
                                            <a class="btn btn-primary btn-lg fst-italic fw-bold shadow" href="{{ route('home.subcategories', $category->id) }}">{{ $category->name }}</a>
                                        @endforeach
                                    </div>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
