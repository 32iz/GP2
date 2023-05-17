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
                    <div class='table-responsive'>
                        <table class="table">
                            <tr>
                                <th style="width:50%" class="fst-italic text-primary align-middle">
                                    <div style="font-size: 3vw;" class="text-center">
                                        Choose <br /> from these <br /> Categories:
                                    </div>
                                </th>
                                <th style="width:50%" class="align-middle">
                                    <div class="d-grid gap-3 mx-auto">
                                        @foreach ($subcategories as $key => $subcategory)
                                            <a class="btn btn-primary btn-lg fst-italic fw-bold shadow" href="{{ route('home.ordersummary', $subcategory->id) }}">{{ $subcategory->name }}</a>
                                        @endforeach

                                    </div>
                                </th>
                            </tr>

                        </table>
                    </div>
                    <div class="pull-right">
                        <a class="btn btn-danger btn-lg fw-bold shadow" href="{{ route('home') }}"> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
