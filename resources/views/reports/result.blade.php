@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Laporan Penjualan Bulan {{ $month->format('F Y') }}</h3>
        </div>
        <div class="card-body">
            <p><strong>Total Penjualan:</strong> Rp {{ number_format($sales, 2, ',', '.') }}</p>

            <!-- Detailed sales information table -->
            <table class="table table-striped mt-4">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>ID Order</th>
                        <th>Tanggal</th>
                        <th>Meja</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->tanggal }}</td>
                            <td>{{ $order->meja->nomor_meja }}</td>
                            <td>Rp {{ number_format($order->total_harga, 2, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data untuk bulan ini.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <a href="{{ route('reports.index') }}" class="btn btn-secondary mt-4">Kembali</a>
        </div>
    </div>
</div>
@endsection
