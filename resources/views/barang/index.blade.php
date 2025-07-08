@extends('template.components.default')

@section('content')

    <div class="row">
        <div class="col-md-6">
            <h3>Barang</h3>
        </div>
        <div class="col-md-6">
            <a href="{{ route('barang.create') }}" class="btn btn-success btn-sm float-end">
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
                        <th scope="col">Nama</th>
                        <th scope="col">Merk</th>
                        <th scope="col">Tipe</th>
                        <th scope="col">Satuan</th>
                        <th style="width: 200px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barangs as $barang)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $barang['nama_barang'] }}</td>
                            <td>{{ $barang['merk'] }}</td>
                            <td>{{ $barang['tipe'] }}</td>
                            <td>{{ $barang['satuan'] }}</td>
                            <td>@include('barang.action')</td>
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
