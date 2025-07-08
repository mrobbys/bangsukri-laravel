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
        $user = Auth::user();
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
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $user->id,
            ],
            [
                'name.required' => 'Nama harus diisi.',
                'email.required' => 'Email harus diisi.',
                'email.email' => 'Format email tidak valid.',
                'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            ]
        );

        if ($user->update($validatedData)) {
            return redirect()->route('profile', ['name' => $user->name])->with(
                'alert',
                [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Data berhasil diubah.'
                ]
            );
        }

        return back()->with('alert', [
            'icon' => 'error',
            'title' => 'Gagal!',
            'message' => 'Data gagal diubah.'
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
                return redirect()->route('profile', ['name' => $user->name])->with('alert', [
                    'icon' => 'success',
                    'title' => 'Berhasil!',
                    'message' => 'Password berhasil diubah.'
                ]);
            }
        }

        return back()->with(
            'alert',
            [
                'icon' => 'error',
                'title' => 'Gagal!',
                'message' => 'Password gagal diubah.'
            ]
        );
    }
}
