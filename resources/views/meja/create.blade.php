@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title">Tambahkan Meja</h3>
        <a href="{{ route('mejas.index') }}" class="btn btn-secondary">Back to List</a>
    </div>
    <div class="card-body">
        <form action="{{ route('mejas.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nomor_meja">Nomor Meja</label>
                <input type="text" class="form-control" id="nomor_meja" name="nomor_meja" placeholder="Masukkan nomor meja" required>
            </div>
            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
