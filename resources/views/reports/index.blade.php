@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card card-primary shadow-sm mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Laporan Penjualan Per Bulan</h3>
                <a href="{{ route('home') }}" class="btn btn-secondary">Back to Dashboard</a>

            </div>
        <div class="card-body">
            <form action="{{ route('reports.generate') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="month">Pilih Bulan</label>
                    <input type="month" class="form-control" id="month" name="month" required>
                </div>
                <button type="submit" class="btn btn-primary">Generate Report</button>
            </form>
        </div>
        </div>
    </div>
@endsection
