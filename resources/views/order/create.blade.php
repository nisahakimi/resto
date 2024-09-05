@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Tambahkan Order</h3>
            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
        <div class="card-body">
            <form action="{{ route('orders.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="order_status">Status</label>
                    <select class="form-control" id="order_status" name="order_status" required>
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukkan tanggal" required>
                </div>
                <div class="form-group">
                    <label for="id_meja">Meja</label>
                    <select class="form-control" id="id_meja" name="id_meja" required>
                        <option value="" disabled selected>Pilih Meja</option>
                        @foreach ($mejas as $meja)
                            <option value="{{ $meja->id }}">{{ $meja->nomor_meja }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Order Items Section -->
                <div id="order-items">
                    <div class="item-row">
                        <div class="form-group">
                            <label for="id_menu_1">Item</label>
                            <select class="form-control" id="id_menu_1" name="menus[0][id_menu]" required>
                                <option value="" disabled selected>Pilih Item</option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->nama_menu }} - {{ $menu->harga }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantity_1">Jumlah</label>
                            <input type="number" class="form-control" id="quantity_1" name="menus[0][quantity]" placeholder="Jumlah" min="1" required>
                        </div>
                        <button type="button" class="btn btn-danger remove-item">Remove</button>
                    </div>
                </div>
                <button type="button" id="add-item" class="btn btn-secondary">Add Item</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('add-item').addEventListener('click', function() {
            var container = document.getElementById('order-items');
            var index = container.querySelectorAll('.item-row').length;
            var newItemRow = document.createElement('div');
            newItemRow.className = 'item-row';
            newItemRow.innerHTML = `
                <div class="form-group">
                    <label for="id_menu_${index + 1}">Item</label>
                    <select class="form-control" id="id_menu_${index + 1}" name="menus[${index}][id_menu]" required>
                        <option value="" disabled selected>Pilih Item</option>
                        @foreach ($menus as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->nama_menu }} - {{ $menu->harga }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="quantity_${index + 1}">Jumlah</label>
                    <input type="number" class="form-control" id="quantity_${index + 1}" name="menus[${index}][quantity]" placeholder="Jumlah" min="1" required>
                </div>
                <button type="button" class="btn btn-danger remove-item">Remove</button>
            `;
            container.appendChild(newItemRow);
        });

        document.getElementById('order-items').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-item')) {
                e.target.parentElement.remove();
            }
        });
    </script>
@endsection
