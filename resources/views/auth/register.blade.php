@extends('template.components.auth')

@section('content')
    <div class="card shadow-lg w-100" style="max-width: 480px;">
        <div class="card-body">
            <div class="text-center">
                <h1 class="card-title h3">Sign Up</h1>
            </div>
            <div class="mt-4">
                <form action="{{ route('register') }}" method="POST" x-data="{
                    form: {
                        name: '{{ old('name') }}',
                        username: '{{ old('username') }}',
                        password: '',
                        password_confirmation: ''
                    },
                    show: true,
                    get isNameInvalid() {
                        return this.form.name.length > 0 && this.form.name.match(/[^a-zA-Z\s\.]/);
                    },
                    get isUsernameInvalid() {
                        return this.form.username.length > 0 && this.form.username.match(/[^a-zA-Z0-9]/);
                    },
                    get isPasswordNotMatch() {
                        return this.form.password !== this.form.password_confirmation && this.form.password_confirmation.length > 0;
                    },
                    get isPasswordMatch() {
                        return this.form.password === this.form.password_confirmation && this.form.password_confirmation.length > 0;
                    }
                }">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" placeholder="John Doe" :value="form.name"
                            x-model="form.name"
                            :class="['form-control', '@error('name') ? 'border-danger' : '' @enderror', isNameInvalid ?
                                'border-danger' : ''
                            ]"
                            @input="if ($event.target.value.match(/[^a-zA-Z\s\.]/)) {
                                        $event.target.value = $event.target.value.replace(/[^a-zA-Z\s\.]/g, ''); errorMessage = 'Nama hanya boleh mengandung huruf.';
                                    } else {
                                        errorMessage = '';
                                    }">
                        {{-- Menampilkan pesan error dari Alpine.js --}}
                        <small x-show="isNameInvalid" x-cloak class="text-danger">
                            Nama hanya boleh mengandung huruf.
                        </small>
                        {{-- Menampilkan pesan error dari Laravel --}}
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3" x-data="{ username: '{{ old('username') }}', errorMessage: '' }">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" x-model="form.username"
                            :class="['form-control', isUsernameInvalid ? 'border-danger' : '',
                                '@error('username') ? 'border-danger' : '' @enderror'
                            ]"
                            placeholder="johndoe" name="username" :value="username"
                            @input="if ($event.target.value.match(/[^a-zA-Z0-9]/)) {
                                        $event.target.value = $event.target.value.replace(/[^a-zA-Z0-9]/g, ''); errorMessage = 'Username hanya boleh mengandung huruf dan angka.';
                                    } else {
                                        errorMessage = '';
                                    }
                                    username = $event.target.value;">
                        {{-- Menampilkan pesan error dari Alpine.js --}}
                        <small x-show="isUsernameInvalid" x-cloak class="text-danger">
                            Username hanya boleh mengandung huruf dan angka.
                        </small>
                        {{-- <small x-show="errorMessage" class="text-danger" x-text="errorMessage"></small> --}}

                        {{-- Menampilkan pesan error dari Laravel --}}
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') border-danger @enderror" id="email"
                            placeholder="example@gmail.com" name="email" value="{{ old('email') }}">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3" x-data="{ show: true }">
                        <label for="password" class="form-label">Password</label>
                        <div class="position-relative">
                            <input :type="show ? 'password' : 'text'"
                                class="form-control @error('password') border-danger @enderror" id="password"
                                name="password" x-model="form.password">
                            <i class="fas fa-eye d-block position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-none': !show, 'd-block': show }"></i>
                            <i class="fas fa-eye-slash d-none position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-block': !show, 'd-none': show }"></i>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3" x-data="{ show: true }">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <div class="position-relative">
                            <input :type="show ? 'password' : 'text'"
                                :class="['form-control', isPasswordNotMatch ? 'border-danger' : '', isPasswordMatch ?
                                    'border-success' : ''
                                ]"
                                id="password_confirmation" name="password_confirmation" x-model="form.password_confirmation"
                                x-cloak>
                            <i class="fas fa-eye d-block position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-none': !show, 'd-block': show }"></i>
                            <i class="fas fa-eye-slash d-none position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-block': !show, 'd-none': show }"></i>
                        </div>
                        <small x-show="isPasswordNotMatch" x-cloak class="text-danger">
                            Konfirmasi password tidak cocok.
                        </small>
                        <small x-show="isPasswordMatch" x-cloak class="text-success">
                            Konfirmasi password cocok.
                        </small>
                        @error('password_confirmation')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="d-grid my-3">
                        <button type="submit" class="btn btn-dark btn-lg">Sign Up</button>
                    </div>
                    <p class="text-center text-muted mt-4">Already have an account?
                        <a href="{{ route('login') }}" class="text-decoration-none">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
