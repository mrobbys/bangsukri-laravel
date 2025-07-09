@extends('template.components.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Tambah Data Jabatan</h3>
        </div>
        <div class="col-md-6">
            <a href="{{ route('jabatan.index') }}" class="btn btn-primary btn-sm float-end">
                <i class="fa fa-arrow-circle left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card px-3 py-3">
        <form action="{{ route('jabatan.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="nama_jabatan">Nama Jabatan</label>
                <input type="text" class="form-control @error('nama_jabatan') is-invalid @enderror" name="nama_jabatan"
                    id="nama_jabatan" value="{{ old('nama_jabatan') }}">
                @error('nama_jabatan')
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
