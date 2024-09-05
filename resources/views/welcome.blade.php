@extends('layouts.app')

@section('title', 'Welcome to My Resto')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome') }}</div>

                    <div class="card-body">
                        <h3>Welcome to My Resto</h3>
                        <p>This is the system where you can manage orders and more!</p>
                        @if (Auth::check())
                            <a href="{{ route('home') }}" class="btn btn-primary">Go to Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                            <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
