<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil users dengan relasi roles untuk ditampilkan di tabel, paginasi 10
        $users = User::with('roles')->latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        // Ambil semua role untuk ditampilkan di dropdown form
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'role' => 'required|string|exists:roles,name', // Pastikan role yang dikirim valid
        ]);

        // Gunakan transaction untuk memastikan user dan role berhasil ditetapkan
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make('12345678'), // Password default
            ]);

            // Berikan role kepada user baru
            $user->assignRole($request->role);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'User berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat membuat user.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        // Ambil role yang saat ini dimiliki user
        $userRole = $user->roles->pluck('name')->first();

        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string|exists:roles,name',
        ]);

        DB::beginTransaction();
        try {
            // Siapkan data untuk diupdate
            $userData = $request->only('name', 'email');

            // Jika password diisi, hash dan tambahkan ke data
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            $user->update($userData);

            // Gunakan syncRoles untuk update. Ini akan menghapus role lama dan menetapkan yang baru.
            $user->syncRoles($request->role);

            DB::commit();

            return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan saat memperbarui user.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Pengaman: jangan biarkan user menghapus dirinya sendiri
        if (Auth::id() == $user->id) {
            return back()->with('error', 'Anda tidak dapat menghapus akun Anda sendiri.');
        }

        // Pengaman: jangan biarkan user biasa menghapus super-admin
        if ($user->hasRole('super-admin')) {
            return back()->with('error', 'User Super Admin tidak dapat dihapus.');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }

    public function resetPassword(User $user)
    {
        // Pengaman: jangan biarkan user mengubah password dirinya sendiri
        if (Auth::id() == $user->id) {
            return back()->with('error', 'Anda tidak dapat mereset password akun Anda sendiri.');
        }

        // Set password default
        $user->password = Hash::make('12345678');
        $user->save();

        return redirect()->back()->with('success', 'Password user berhasil direset ke default (12345678).');
    }
}
