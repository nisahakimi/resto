@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <a href="{{ route('home') }}" class="btn btn-secondary">Back to Dashboard</a>
    <div class="card card-primary shadow-sm mt-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Data Meja</h3>
            @if(auth()->user()->role == 'admin')
            <a href="{{ route('mejas.create') }}" class="btn btn-primary">
                Tambah Data Meja
            </a>
            @endif
        </div>

        @if (session()->has('pesan'))
            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                <div class="alert-body">
                    {{ session()->get('pesan') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Nomor Meja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mejas as $meja)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $meja->nomor_meja }}</td>
                                <td>
                                    <a href="{{ route('mejas.edit', ['meja' => $meja->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    @if(auth()->user()->role == 'admin')
                                    <form action="{{ route('mejas.destroy', ['meja' => $meja->id]) }}" method="POST" style="display:inline">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


    </div>
</div>
@endsection
