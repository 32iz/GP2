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
                    <table class="table">
                        <tr>
                            <div class="fs-1 fw-bold fst-italic text-primary align-middle text-center">
                                Your order is: <br />
                            </div>
                            @foreach ($subcategories as $key => $subcategory)
                                <th class="fs-1 fst-italic text-success align-middle text-center">
                                    {{ $loop->iteration }}- {{ $subcategory->name }}
                                </th>
                            @endforeach
                        </tr>
                        <tr>
                            <th class="text-center">
                            <br><br><br><br>
                                <a class="btn btn-danger btn-lg fw-bold shadow" href="{{ route('home') }}">Cancle</a>
                                <a class="btn btn-success btn-lg fst-italic fw-bold shadow mx-auto" href="{{ route('email.send',$subcategory->id) }}">Send The Order!</a>
                            </th>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
