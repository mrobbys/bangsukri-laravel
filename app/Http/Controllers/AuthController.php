<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login', ["title" => "Login"]);
    }

    public function loginProcess(Request $request)
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'password.required' => 'Password harus diisi',
            ]
        );

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            // cek role apakah admin
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.index')->with('alert', [
                    'icon' => 'success',
                    'title' => 'Login Berhasil!',
                    'text' => 'Selamat datang Admin, ' . Auth::user()->username
                ]);
            }

            return redirect()->route('dashboard')->with('alert', [
                'icon' => 'success',
                'title' => 'Login Berhasil!',
                'text' => 'Selamat datang, ' . Auth::user()->name
            ]);
        }

        return back()->with('alert', [
            'icon' => 'error',
            'title' => 'Login Gagal!',
            'text' => 'Email atau password salah'
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('alert', [
            'icon' => 'success',
            'title' => 'Logout Berhasil!',
            'text' => null
        ]);
    }

    public function register()
    {
        return view('auth.register', ["title" => "Register"]);
    }

    public function registerProcess(Request $request)
    {
        $validatedData = $request->validate(
            [
                'name' => 'required|regex:/^[a-zA-Z\s]+$/u',
                'username' => 'required|regex:/^[a-zA-Z0-9]+$/|unique:users,username',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|confirmed'
            ],
            [
                'name.required' => 'Nama harus diisi',
                'name.regex' => 'Nama hanya boleh mengandung huruf dan spasi',
                'username.required' => 'Username harus diisi',
                'username.regex' => 'Username tidak boleh mengandung spasi',
                'username.unique' => 'Username sudah terdaftar',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Email tidak valid',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.confirmed' => 'Password tidak cocok',
            ]
        );

        $user = User::create([
            'name' => $validatedData['name'],
            'username' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password'])
        ]);

        Auth::login($user);
        return redirect()->route('dashboard')->with(
            'alert',
            [
                'icon' => 'success',
                'title' => 'Register Berhasil!',
                'text' => 'Selamat datang, ' . Auth::user()->name
            ]
        );
    }

    public function forgotPassword()
    {
        return view('auth.forgot-password', ["title" => "Forgot Password"]);
    }

    public function forgotPasswordProcess(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        // Validasi email, pastikan ada di database
        $request->validate(
            ['email' => 'required|email|exists:users,email'],
            [
                'email.required' => 'Email wajib diisi.',
                'email.email'    => 'Format email tidak valid.',
                'email.exists'   => 'Email tidak terdaftar.',
            ]
        );

        // Simpan email di session untuk digunakan di langkah berikutnya
        session(['email_for_password_reset' => $request->email]);

        // Arahkan ke halaman untuk memasukkan password baru
        return redirect()->route('password.reset')->with(
            'alert',
            [
                'icon' => 'success',
                'title' => 'Halo, ' . $user->name,
                'text' => 'Silakan masukkan password baru Anda.'
            ]
        );
    }

    public function showResetPasswordForm()
    {
        // Ambil email dari session
        $email = session('email_for_password_reset');

        // Jika tidak ada email di session (misal, akses URL langsung),
        // kembalikan ke halaman awal lupa password.
        if (!$email) {
            return redirect()->route('password.request')->with(
                'alert',
                [
                    'icon' => 'error',
                    'title' => 'Terjadi kesalahan',
                    'text' => 'Email tidak ditemukan.'
                ]
            );
        }

        return view('auth.forgot-password-confirmation', [
            "title" => "Reset Password",
            "email" => $email
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate(
            [
                'email'    => 'required|email|exists:users,email',
                'password' => 'required|confirmed|min:8',
            ],
            [
                'password.required'  => 'Password baru wajib diisi.',
                'password.confirmed' => 'Konfirmasi password tidak cocok.',
                'password.min'       => 'Password minimal harus 8 karakter.',
            ]
        );

        // Cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // Jika user tidak ditemukan (meskipun seharusnya ada karena sudah divalidasi)
        if (!$user) {
            return redirect()->route('password.request')->with(
                'alert',
                [
                    'icon' => 'error',
                    'title' => 'Terjadi kesalahan',
                    'text' => 'Email tidak ditemukan.'
                ]
            );
        }

        // Update password user
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // Hapus email dari session setelah selesai
        $request->session()->forget('email_for_password_reset');

        return redirect()->route('login')->with(
            'alert',
            [
                'icon' => 'success',
                'title' => 'Reset Password Berhasil!',
                'text' => 'Silakan login menggunakan password baru Anda.'
            ]
        );
    }
}
