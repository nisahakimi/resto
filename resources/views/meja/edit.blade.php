@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title">Update Meja</h3>
            <a href="{{ route('mejas.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
        <div class="card-body">
            <form action="{{ route('mejas.update', ['meja' => $meja->id]) }}" method="POST">
            @method('PATCH')
            @csrf
            <div class="form-group">
                <label for="name">Nomor Meja</label>
                <input type="text" class="form-control" id="nomor_meja" name="nomor_meja"
                    placeholder="Masukkan nomor meja" value="{{ old('nomor_meja') ?? $meja->nomor_meja }}">
            </div>
            <div class="form-group d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    </div>
@endsection
