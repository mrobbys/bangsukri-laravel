@extends('template.components.default')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <h3>Pemasok</h3>
        </div>
        <div class="col-md-6">
            <a href="{{ route('pemasok.create') }}" class="btn btn-success btn-sm float-end">
                <i class="fa fa-plus-circle"></i> Tambah
            </a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <table class="table bg-white rounded shadow-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="width: 50px">#</th>
                        <th scope="col">Nama Pemasok</th>
                        <th scope="col">Nama Kontak</th>
                        <th scope="col">Nomor HP</th>
                        <th scope="col">Alamat</th>
                        <th style="width: 200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemasoks as $pemasok)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $pemasok['nama_pemasok'] }}</td>
                            <td>{{ $pemasok['nama_kontak'] }}</td>
                            <td>{{ $pemasok['nomor_hp'] }}</td>
                            <td>{{ $pemasok['alamat'] }}</td>
                            <td>@include('pemasok.action')</td>
                        </tr>
                    @empty
                        <tr>
                            <td>
                                <h1 class="text-center font-bold">Data Kosong</h1>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <form action="" method="POST" id="deleteForm">
        @csrf
        @method('DELETE')
        <input type="submit" value="Hapus" class="d-none">
    </form>
@endsection
