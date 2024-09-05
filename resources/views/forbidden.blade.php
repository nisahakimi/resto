@extends('layouts.app')

@section('content')
    <h1>403 Forbidden</h1>
    <p>{{ session('error') }}</p>
@endsection
