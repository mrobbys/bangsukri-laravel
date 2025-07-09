<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user(); // langsung pakai ini, tidak perlu Auth::find()
        return view('profile.index', [
            "title" => "Profile",
            "user" => $user
        ]);
    }

    public function changePersonal(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $validatedData = $request->validate(
            [
                'name' => 'required||regex:/^[a-zA-Z\s]+$/u',
                'username' => 'required|regex:/^[a-zA-Z0-9]+$/|unique:users,username,' . $user->id,
                'email' => 'required|email|unique:users,email,' . $user->id,
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'name.regex' => 'Nama hanya boleh mengandung huruf dan spasi.',
                'username.required' => 'Username harus diisi.',
                'username.regex' => 'Username hanya boleh mengandung huruf dan angka.',
                'username.unique' => 'Username sudah digunakan oleh pengguna lain.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            ]
        );

        if ($user->update($validatedData)) {
            return redirect()->route('profile', ['username' => $user->username])->with(
                'alert',
                [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'Data personal berhasil diubah.'
                ]
            );
        }

        return back()->with('alert', [
            'icon' => 'error',
            'title' => 'Gagal!',
            'text' => 'Data gagal diubah.'
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $currentPassword = $request->input('current_password');

        if (!Hash::check($currentPassword, $user->password)) {
            return back()
                ->withErrors(['current_password' => 'Password saat ini salah.']);
        }

        $validatedData = $request->validate(
            [
                'current_password' => 'required',
                'new_password' => 'required|confirmed',
            ],
            [
                'current_password.required' => 'Password saat ini harus diisi.',
                'new_password.required' => 'Password baru harus diisi.',
                'new_password.confirmed' => 'Konfirmasi password tidak cocok.',
            ]
        );

        if (Hash::check($validatedData['current_password'], $user->password)) {
            if ($user->update([
                'password' => Hash::make($validatedData['new_password'])
            ])) {
                return redirect()->route('profile', ['username' => $user->username])->with('alert', [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'text' => 'Password berhasil diubah.'
                ]);
            }
        }

        return back()->with(
            'alert',
            [
                'icon' => 'error',
                'title' => 'Gagal!',
                'text' => 'Password gagal diubah.'
            ]
        );
    }
}
