@extends('template.components.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h3>Ubah Data Ruang</h3>
        </div>
        <div class="col-md-6">
            <a href="{{ route('ruang.index') }}" class="btn btn-primary btn-sm float-end">
                <i class="fa fa-arrow-circle left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card px-3 py-3">
        <form action="{{ route('ruang.update', $ruang) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_ruang">Nama Ruang</label>
                <input type="text" class="form-control @error('nama_ruang') is-invalid @enderror" name="nama_ruang"
                    id="nama_ruang" value="{{ old('nama_ruang') ?? $ruang->nama_ruang }}" required>
                @error('nama_ruang')
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
