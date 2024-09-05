@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('home') }}" class="btn btn-secondary">Back to Dashboard</a>

    <div class="card card-primary shadow-sm mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mr-auto">Data Pembayaran</h3>
            <div class="card-header-action">
                <a href="{{ route('pembayarans.create') }}" class="btn btn-primary">
                    Tambah Pembayaran </a>
            </div>
        </div>

        @if (session()->has('pesan'))
            <div class="alert alert-success alert-dismissible show fade">
                <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    {{ session()->get('pesan') }}
                </div>
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>ID Order</th>
                            <th>Tanggal</th>
                            <th>Total</th>
                            {{-- @if (auth()->user()->role == 'admin')
                                <th>Aksi</th>
                            @endif --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($pembayarans as $pembayaran)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $pembayaran->order->id }}</a></td>
                                <td>{{ $pembayaran->tanggal }}</td>
                                <td>{{ $pembayaran->total_bayar }}</td>
                                {{-- @if (auth()->user()->role == 'admin')
                                    <td>
                                        <form action="{{ route('pembayarans.destroy', ['pembayaran' => $pembayaran->id]) }}"
                                            method="POST" style="display:inline">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger ml-3">Hapus</button>
                                        </form>
                                        <a href="{{ route('pembayarans.edit', ['pembayaran' => $pembayaran->id]) }}"
                                            class="btn btn-primary">Edit</a>
                                    </td>
                                @endif --}}
                            </tr>
                        @empty
                            <td colspan="6" class="text-center">Tidak ada data!</td>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>
@endsection
