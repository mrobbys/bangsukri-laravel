@extends('template.components.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Tambah Data Karyawan</h3>
        </div>
        <div class="col-md-6">
            <a href="{{ route('karyawan.index') }}" class="btn btn-primary btn-sm float-end">
                <i class="fa fa-arrow-circle left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card px-3 py-3">
        <form action="{{ route('karyawan.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="nama_karyawan">Nama Karyawan</label>
                <input type="text" class="form-control @error('nama_karyawan') is-invalid @enderror" name="nama_karyawan"
                    id="nama_karyawan" value="{{ old('nama_karyawan') }}">
                @error('nama_karyawan')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="jabatan_id">Nama Jabatan</label>
                <select name="jabatan_id" id="jabatan_id" class="form-control @error('jabatan_id') is-invalid @enderror">
                    <option value="" selected>--- Pilih Jabatan ---</option>
                    @foreach ($jabatans as $jabatan)
                        <option value="{{ $jabatan->id }}" @selected(old('jabatan_id') == $jabatan->id)>{{ $jabatan->nama_jabatan }}
                        </option>
                    @endforeach
                </select>
                @error('jabatan_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="nomor_hp">Nomor Handphone</label>
                <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror" name="nomor_hp"
                    id="nomor_hp" value="{{ old('nomor_hp') }}">
                @error('nomor_hp')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                    id="alamat" value="{{ old('alamat') }}">
                @error('alamat')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="col mb-3">
                <button class="btn btn-success" type="submit">
                    <i class="fas fa-save"></i>
                    Simpan
                </button>
            </div>
        </form>
    </div>
@endsection
