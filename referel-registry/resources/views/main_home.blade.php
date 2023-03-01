@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center">
                        <h4>Referral Registration</h4>
                        @if (auth()->user())
                            @if (auth()->user()->type == 'admin')
                                <a class="btn btn-sm btn-primary" href="{{ route('admin.home') }}">Dashboard</a>
                            @else
                                <a class="btn btn-sm btn-primary" href="{{ route('users.home') }}">Dashboard</a>
                            @endif
                        @else
                            <a class="btn btn-sm btn-success" href="{{ route('login') }}">Login</a>
                            <a class="btn btn-sm btn-primary" href="{{ route('register') }}">Register</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
