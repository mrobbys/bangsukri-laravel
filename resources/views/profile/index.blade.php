@extends('template.components.auth')

@section('content')
    @push('scripts')
        <script>
            // script untuk disabled button pada form changePersonal
            function formWatcherPersonal() {
                return {
                    // Nilai awal dari backend (dari Laravel)
                    original: {
                        name: '{{ old('name', $user->name) }}',
                        username: '{{ old('username', $user->username) }}',
                        email: '{{ old('email', $user->email) }}',
                    },
                    // Nilai saat ini yang diubah oleh user
                    form: {
                        name: '{{ old('name', $user->name) }}',
                        username: '{{ old('username', $user->username) }}',
                        email: '{{ old('email', $user->email) }}',
                    },
                    hasChanged: false, // Status apakah ada perubahan

                    checkChanges() {
                        this.hasChanged = (
                            this.form.name !== this.original.name ||
                            this.form.username !== this.original.username ||
                            this.form.email !== this.original.email
                        );
                    }
                };
            }

            // script untuk disabled button pada form changePassword
            function formWatcherPassword() {
                return {
                    form: {
                        current_password: '',
                        new_password: '',
                        new_password_confirmation: '',
                    },
                    hasChanged: false,
                    checkChanges() {
                        this.hasChanged = (
                            this.form.current_password.length > 0 &&
                            this.form.new_password.length > 0 &&
                            this.form.new_password === this.form.new_password_confirmation
                        );
                    }
                };
            }
        </script>
    @endpush

    <div class="container py-5">

        <div class="mb-3">
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-secondary">&laquo; Kembali</a>
        </div>

        <h2 class="mb-4">User Settings</h2>
        <form x-data="formWatcherPersonal()" @input="checkChanges" action="{{ route('profile.changePersonal', $user->username) }}"
            method="POST">
            @csrf
            @method('PUT')
            <div class="row mb-4">
                <div class="col-lg-6">
                    <h4>Personal Information</h4>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" x-model="form.name" x-cloak
                            value="{{ old('name', $user->name) }}">
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" x-model="form.username"
                            x-cloak value="{{ old('username', $user->username) }}">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" x-model="form.email"
                            x-cloak value="{{ old('email', $user->email) }}">
                    </div>

                    <div class="row align-items-center justify-content-between gap-2">
                        <button class="btn btn-primary col-12 col-sm-3 changePersonal-button" type="submit"
                            :disabled="!hasChanged" data-form-type="personal">
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <hr>

        <form x-data="formWatcherPassword()" @input="checkChanges" action="{{ route('profile.changePassword', $user->username) }}"
            method="POST">
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
                                id="current_password" name="current_password" x-model="form.current_password">
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
                                name="new_password" x-model="form.new_password">
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
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <div class="position-relative">
                            <input :type="show ? 'password' : 'text'"
                                class="form-control @error('new_password_confirmation') border-danger @enderror"
                                id="new_password_confirmation" name="new_password_confirmation"
                                x-model="form.new_password_confirmation">
                            <i class="fas fa-eye d-block position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-none': !show, 'd-block': show }"></i>
                            <i class="fas fa-eye-slash d-none position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-block': !show, 'd-none': show }"></i>
                        </div>
                        <small
                            x-show="form.new_password !== form.new_password_confirmation && form.new_password_confirmation.length > 0"
                            x-cloak class="text-danger">
                            Konfirmasi password tidak cocok.
                        </small>
                        @error('new_password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row align-items-center justify-content-between gap-2">
                        <button class="btn btn-primary col-12 col-sm-3 changePersonal-button" type="submit"
                            :disabled="!hasChanged" data-form-type="password">Simpan</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
