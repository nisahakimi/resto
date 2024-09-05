@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('home') }}" class="btn btn-secondary">Back to Dashboard</a>

    <div class="card card-primary shadow-sm mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mr-auto">Data Order</h3>
            <div class="card-header-action">
                <a href="{{ route('orders.create') }}" class="btn btn-primary">
                    Tambah Order
                </a>
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
            <div class="row">
                @forelse ($orders as $order)
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-header">
                                Order #{{ $loop->iteration }}
                            </div>
                            <div class="card-body">
                                <p><strong>Status:</strong> {{ $order->order_status }}</p>
                                <p><strong>Nomor Meja:</strong> {{ $order->meja->nomor_meja }}</p>
                                <p><strong>Tanggal:</strong> {{ $order->tanggal }}</p>
                                <p><strong>Total Harga:</strong> {{ $order->total_harga }}</p>

                                @if ($order->order_status == 'pending')
                                    @if (auth()->user()->role == 'admin')
                                        <form action="{{ route('orders.destroy', ['order' => $order->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('orders.edit', ['order' => $order->id]) }}" class="btn btn-primary mt-2">Edit</a>
                                @else
                                    <p class="text-muted mt-2">This order cannot be edited or deleted.</p>
                                @endif
                            </div>
                            <div class="card-footer">
                                <h5>Order Items</h5>
                                <ul class="list-group">
                                    @forelse ($order->items as $item)
                                        <li class="list-group-item">
                                            <strong>ID Menu:</strong> {{ $item->id_menu }}
                                            <br>
                                            <strong>Nama Menu:</strong> {{ $item->menu->nama_menu }}
                                            <br>
                                            <strong>Kuantitas:</strong> {{ $item->quantity }}
                                        </li>
                                    @empty
                                        <li class="list-group-item">No items found</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center">Tidak ada data!</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
