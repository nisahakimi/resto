@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary">Back to Dashboard</a>

        <div class="card card-primary shadow-sm mt-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mr-auto">Data Menu</h3>
                @if (auth()->user()->role == 'admin')
                    <div class="card-header-action">
                        <a href="{{ route('menus.create') }}" class="btn btn-primary">
                            Tambah Data Menu
                        </a>
                    </div>
                @endif
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
                                <th>No</th>
                                <th>Nama Menu</th>
                                <th>Deskripsik</th>
                                <th>Harga</th>
                                <th>Ketersediaan</th>
                                @if (auth()->user()->role == 'admin')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($menus as $menu)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td>{{ $menu->nama_menu }}</a></td>
                                    <td>{{ $menu->deskripsi }}</td>
                                    <td>{{ $menu->harga }}</td>
                                    <td>{{ $menu->ketersediaan }}</td>
                                    @if (auth()->user()->role == 'admin')
                                        <td>
                                            <form action="{{ route('menus.destroy', ['menu' => $menu->id]) }}"
                                                method="POST" style="display:inline">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger ml-3">Hapus</button>
                                            </form>
                                            <a href="{{ route('menus.edit', ['menu' => $menu->id]) }}"
                                                class="btn btn-primary">Edit</a>
                                        </td>
                                    @endif
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
