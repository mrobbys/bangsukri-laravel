@extends('template.components.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Barang Masuk</h3>
        </div>
        <div class="col-md-6">
            @can('create barang masuk')
                <a href="{{ route('barang_masuk.create') }}" class="btn btn-success btn-sm float-end">
                    <i class="fa fa-plus-circle"></i> Tambah
                </a>
            @endcan
        </div>
    </div>
    <div class="row mt-3">
        <div class="col">
            <table class="table bg-white rounded shadow-sm table-hover">
                <thead>
                    <tr>
                        <th scope="col" style="width: 50px">#</th>
                        <th scope="col">Tanggal</th>
                        <th scope="col">Sumber Dana</th>
                        <th scope="col">Pemasok</th>
                        <th scope="col">Penerima</th>
                        @can('edit barang masuk')
                            <th style="width: 200px">Aksi</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @forelse ($barang_masuks as $barang_masuk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ date('d-m-Y', strtotime($barang_masuk->tanggal)) }}</td>
                            <td>{{ $barang_masuk['sumber_dana'] }}</td>
                            <td>{{ $barang_masuk['pemasok']->nama_pemasok }}</td>
                            <td>{{ $barang_masuk['karyawan']->nama_karyawan }}</td>
                            <td>@include('barang_masuk.action')</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
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
