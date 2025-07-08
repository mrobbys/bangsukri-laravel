@extends('template.components.auth')

@section('content')
    <div class="card shadow-lg w-100" style="max-width: 480px;">
        <div class="card-body">
            <div class="text-center">
                <h1 class="card-title h3">Enter Your New Password</h1>
            </div>
            <div class="mt-4">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') border-danger @enderror" id="email"
                            placeholder="example@gmail.com" name="email" value="{{ $email }}" readonly>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3" x-data="{ show: true }">
                        <label for="password" class="form-label">New Password</label>
                        <div class="position-relative">
                            <input :type="show ? 'password' : 'text'"
                                class="form-control @error('password') border-danger @enderror" id="password"
                                name="password">
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
                        <label for="password_confirmation" class="form-label">New Password Confirmation</label>
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
                    <div class="d-grid my-3">
                        <button type="submit" class="btn btn-dark btn-lg">Submit</button>
                    </div>
                    <p class="text-center text-muted mt-4">Already have an account?
                        <a href="{{ route('login') }}" class="text-decoration-none">Sign in</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
