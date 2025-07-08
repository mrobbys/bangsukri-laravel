@extends('template.components.auth')

@section('content')
    <div class="card shadow-lg w-100" style="max-width: 480px;">
        <div class="card-body">
            <div class="text-center">
                <h1 class="card-title h3">Enter Your Email</h1>
            </div>
            <div class="mt-4">
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') border-danger @enderror" id="email"
                            placeholder="example@gmail.com" name="email" value="{{ old('email') }}">
                        @error('email')
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
