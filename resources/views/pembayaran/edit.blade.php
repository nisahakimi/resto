@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">

            <h3 class="card-title">Edit Pembayaran</h3>
            <a href="{{ route('pembayarans.index') }}" class="btn btn-secondary">Back to List</a>

        </div>
    <div class="card-body">

        <form action="{{ route('pembayarans.update', ['pembayaran' => $pembayaran->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal"
                    value="{{ old('tanggal', $pembayaran->tanggal) }}" placeholder="Masukkan tanggal">
            </div>

            <div class="form-group">
                <label for="total_bayar">Total Bayar</label>
                <input type="number" class="form-control" id="total_bayar" name="total_bayar"
                    value="{{ old('total_bayar', $pembayaran->total_bayar) }}" placeholder="Masukkan total bayar"
                    step="0.01">
            </div>

            <div class="form-group">
                <label for="id_order">Order</label>
                <select class="form-control" id="id_order" name="id_order">
                    <option value="" disabled>Pilih Order</option>
                    @foreach ($orders as $order)
                        <option value="{{ $order->id }}" {{ $order->id == $pembayaran->id_order ? 'selected' : '' }}>
                            {{ $order->id }} - {{ $order->order_status }} - {{ $order->tanggal }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    </div>
@endsection
