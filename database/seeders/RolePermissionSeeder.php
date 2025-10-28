<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // buat permission
        Permission::create(['name' => 'view ruang']);
        Permission::create(['name' => 'create ruang']);
        Permission::create(['name' => 'edit ruang']);
        Permission::create(['name' => 'delete ruang']);

        Permission::create(['name' => 'view karyawan']);
        Permission::create(['name' => 'create karyawan']);
        Permission::create(['name' => 'edit karyawan']);
        Permission::create(['name' => 'delete karyawan']);

        Permission::create(['name' => 'view pemasok']);
        Permission::create(['name' => 'create pemasok']);
        Permission::create(['name' => 'edit pemasok']);
        Permission::create(['name' => 'delete pemasok']);

        Permission::create(['name' => 'view barang']);
        Permission::create(['name' => 'create barang']);
        Permission::create(['name' => 'edit barang']);
        Permission::create(['name' => 'delete barang']);

        Permission::create(['name' => 'view barang masuk']);
        Permission::create(['name' => 'create barang masuk']);
        Permission::create(['name' => 'edit barang masuk']);
        Permission::create(['name' => 'delete barang masuk']);

        Permission::create(['name' => 'view jabatan']);
        Permission::create(['name' => 'create jabatan']);
        Permission::create(['name' => 'edit jabatan']);
        Permission::create(['name' => 'delete jabatan']);

        // buat role dan assign permission
        $roleUser = Role::create(['name' => 'user']);
        $roleUser->givePermissionTo(['view barang', 'view karyawan', 'view pemasok', 'view ruang', 'view barang masuk']);

        $roleSuperAdmin = Role::create(['name' => 'super-admin']);
        $roleSuperAdmin->givePermissionTo(Permission::all());

        $roleAdmin = Role::create(['name' => 'admin']);
        $roleAdmin->givePermissionTo([
            'view barang',
            'create barang',
            'edit barang',
            'view karyawan',
            'create karyawan',
            'edit karyawan',
            'view pemasok',
            'create pemasok',
            'edit pemasok',
            'view ruang',
            'create ruang',
            'edit ruang',
            'view barang masuk',
            'create barang masuk',
            'edit barang masuk'
        ]);

        // buat akun
        $user = User::factory()->create([
            'name' => 'Robby',
            'username' => 'robby',
            'email' => 'robby@gmail.com',
            'password' => Hash::make('1'),
        ]);
        $user->assignRole($roleUser);

        $superAdmin = User::factory()->create([
            'name' => 'SuperAdmin',
            'username' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('1'),
        ]);
        $superAdmin->assignRole($roleSuperAdmin);

        $admin = User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('1'),
        ]);
        $admin->assignRole($roleAdmin);
    }
}
