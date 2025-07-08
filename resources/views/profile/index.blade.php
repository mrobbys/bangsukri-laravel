@extends('template.components.auth')

@section('content')
    <div class="container py-5">

        <div class="mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary">&laquo; Kembali</a>
        </div>

        <h2 class="mb-4">User Settings</h2>
        <form action="{{ route('profile.changePersonal', $user->name) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-lg-6">
                    <h4>Personal Information</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text"
                            class="form-control @error('name')
                            border-danger
                        @enderror"
                            id="name" name="name" value="{{ old('name', $user->name) }}">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email"
                            class="form-control @error('email')
                            border-danger
                        @enderror"
                            id="email" name="email" value="{{ old('email', $user->email) }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-primary changePersonal-button" type="submit">Simpan</button>
                </div>
            </div>
        </form>

        <hr>

        <form action="{{ route('profile.changePassword', $user->name) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-lg-6">
                    <h4>Change Password</h4>
                    <div class="mb-3" x-data="{ show: true }">
                        <label for="current_password" class="form-label">Current Password</label>
                        <div class="position-relative">
                            <input :type="show ? 'password' : 'text'"
                                class="form-control @error('current_password') border-danger @enderror"
                                id="current_password" name="current_password">
                            <i class="fas fa-eye d-block position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-none': !show, 'd-block': show }"></i>
                            <i class="fas fa-eye-slash d-none position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-block': !show, 'd-none': show }"></i>
                        </div>
                        @error('current_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3" x-data="{ show: true }">
                        <label for="new_password" class="form-label">New Password</label>
                        <div class="position-relative">
                            <input :type="show ? 'password' : 'text'"
                                class="form-control @error('new_password') border-danger @enderror" id="new_password"
                                name="new_password">
                            <i class="fas fa-eye d-block position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-none': !show, 'd-block': show }"></i>
                            <i class="fas fa-eye-slash d-none position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-block': !show, 'd-none': show }"></i>
                        </div>
                        @error('new_password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3" x-data="{ show: true }">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <div class="position-relative">
                            <input :type="show ? 'password' : 'text'"
                                class="form-control @error('password_confirmation') border-danger @enderror"
                                id="password_confirmation" name="password_confirmation">
                            <i class="fas fa-eye d-block position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-none': !show, 'd-block': show }"></i>
                            <i class="fas fa-eye-slash d-none position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-block': !show, 'd-none': show }"></i>
                        </div>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="d-grid gap-2 d-md-block">
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
        </form>

    </div>
@endsection
