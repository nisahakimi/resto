@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Tambahkan Pembayaran</h3>
            <a href="{{ route('pembayarans.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
        <div class="card-body">
            <form action="{{ route('pembayarans.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal" required>
                </div>

                <div class="form-group">
                    <label for="total_bayar">Total Bayar</label>
                    <input type="text" class="form-control" id="total_bayar" name="total_bayar" placeholder="Total bayar" readonly>
                </div>

                <div class="form-group">
                    <label for="id_order">Order</label>
                    <select class="form-control" id="id_order" name="id_order" onchange="updateTotalBayar()">
                        <option value="" disabled selected>Pilih Order</option>
                        @foreach ($orders as $order)
                            <option value="{{ $order->id }}"
                                    data-total-harga="{{ $order->total_harga }}"
                                    {{ $order->order_status === 'completed' ? 'disabled' : '' }}>
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

    <script>
        function updateTotalBayar() {
            const select = document.getElementById('id_order');
            const selectedOption = select.options[select.selectedIndex];
            const totalHarga = selectedOption ? selectedOption.getAttribute('data-total-harga') : '';
            document.getElementById('total_bayar').value = totalHarga;
        }
    </script>
@endsection
