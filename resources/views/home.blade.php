@extends('layouts.app')

@section('content')
<div class="container mt-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title mb-4">Admin Dashboard</h3>
                        <h5 class="lead">Selamat datang, {{ auth()->user()->username }}!</h5>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Manage Meja</h5>
                                        <p class="card-text">Click to manage table data.</p>
                                        <a href="{{ route('mejas.index') }}" class="btn btn-primary">Go to Meja</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Manage Menu</h5>
                                        <p class="card-text">Manage menu data.</p>
                                        <a href="{{ route('menus.index') }}" class="btn btn-primary">Go to Menu</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Manage Orders</h5>
                                        <p class="card-text">View and manage all orders in the system.</p>
                                        <a href="{{ route('orders.index') }}" class="btn btn-primary">Go to Orders</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Manage Pembayaran</h5>
                                        <p class="card-text">Manage payment data.</p>
                                        <a href="{{ route('pembayarans.index') }}" class="btn btn-primary">Go to Pembayaran</a>
                                    </div>
                                </div>
                            </div>
                            @if(auth()->user()->role == 'admin')
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm">
                                    <div class="card-body text-center">
                                        <h5 class="card-title">Reports</h5>
                                        <p class="card-text">Generate and view various reports.</p>
                                        <a href="{{ route('reports.index') }}" class="btn btn-primary">Go to Reports</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
