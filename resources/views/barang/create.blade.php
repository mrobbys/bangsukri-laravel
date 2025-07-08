@extends('template.components.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Tambah Data Barang</h3>
        </div>
        <div class="col-md-6">
            <a href="{{ route('barang.index') }}" class="btn btn-primary btn-sm float-end">
                <i class="fa fa-arrow-circle left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card px-3 py-3">
        <form action="{{ route('barang.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="nama_barang">Nama Barang</label>
                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang"
                    id="nama_barang" value="{{ old('nama_barang') }}" required>
                @error('nama_barang')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="merk">Merk</label>
                <input type="text" class="form-control @error('merk') is-invalid @enderror" name="merk"
                    id="merk" value="{{ old('merk') }}" required>
                @error('merk')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="tipe">Tipe</label>
                <input type="text" class="form-control @error('tipe') is-invalid @enderror" name="tipe"
                    id="tipe" value="{{ old('tipe') }}" required>
                @error('tipe')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="satuan">Satuan</label>
                <input type="text" class="form-control @error('satuan') is-invalid @enderror" name="satuan"
                    id="satuan" value="{{ old('satuan') }}" required>
                @error('satuan')
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
