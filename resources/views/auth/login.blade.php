@extends('template.components.auth')

@section('content')
    <div class="card shadow-lg w-100" style="max-width: 480px;">
        <div class="card-body">
            <div class="text-center">
                <h1 class="card-title h3">Sign in</h1>
            </div>

            @auth
                <small>Halo, {{ Auth::user()->name }}</small>
            @endauth

            @guest
                <small>Belum Login</small>
            @endguest

            <div class="mt-4">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') border-danger @enderror" id="email"
                            placeholder="example@gmail.com" name="email" value="robby@gmail.com">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3" x-data="{ show: true }">
                        <label for="password" class="form-label">Password</label>
                        <div class="position-relative">
                            <input :type="show ? 'password' : 'text'" class="form-control @error('password') border-danger @enderror" id="password" name="password" value="1">
                            <i class="fas fa-eye d-block position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-none': !show, 'd-block': show }"></i>
                            <i class="fas fa-eye-slash d-none position-absolute top-50 end-0 me-3 translate-middle-y cursor-pointer"
                                @click="show = !show" :class="{ 'd-block': !show, 'd-none': show }"></i>
                        </div>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                                <label class="form-check-label" for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text-end">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot
                                    Password?</a>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid my-3">
                        <button type="submit" class="btn btn-dark btn-lg">Sign in</button>
                    </div>
                    <p class="text-center text-muted mt-4">Don't have an account yet?
                        <a href="{{ route('register') }}" class="text-decoration-none">Sign up</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
@endsection
