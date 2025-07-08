@extends('template.components.auth')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center bg-white shadow-lg p-5 rounded-4">
        <p class="fs-1 fw-bold">404 Not Found</p>
        <h1 class="fs-3 fw-semibold">Yah Gak Ketemu Halamannya🗿😿😹</h1>
        <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3">Kembali</a>
    </div>
@endsection
