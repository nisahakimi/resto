@extends('layouts.app')


@section('content')
    <div class="card">
        <div class="card-body">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title">Update Meja</h3>
                <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
            <div class="card-body">

            <form action="{{ route('menus.update',['menu'=>$menu->id]) }}" method="POST">
                @method('PATCH')
                @csrf

                <div class="form-group">
                    <label for="name">Nama menu</label>
                    <input type="text" class="form-control" id="nama_menu" name="nama_menu"
                        placeholder="Masukkan nama menu" value="{{old('nama_menu') ?? $menu->nama_menu }}">
                </div>
                <div class="form-group">
                    <label for="description">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi"
                        placeholder="Masukkan deskripsi"  value="{{old('deskripsi') ?? $menu->deskripsi }}">
                </div>

                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukkan harga" value="{{old('harga') ?? $menu->harga }}">
                </div>
                <div class="form-group">
                    <label for="availability">Ketersediaan</label>
                    <select class="form-control" id="availability" name="ketersediaan" required>
                        <option value="" disabled selected>Pilih Ketersediaan</option>
                        <option value="1" {{ $menu->ketersediaan == 1 ? 'selected' : '' }}>Tersedia</option>
                        <option value="0" {{ $menu->ketersediaan == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                </div>
                <div class="form-group d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
