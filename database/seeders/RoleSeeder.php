<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat roles
        $admin = Role::create(['name' => 'admin']);
        $user  = Role::create(['name' => 'user']);
        $pro   = Role::create(['name' => 'pro']);

        // Buat user admin default
        User::create([
            'name'     => 'Super Admin',
            'email'    => 'admin@nursteps.com',
            'password' => Hash::make('password'),
            'role_id'  => $admin->id,
        ]);

        // Buat user biasa untuk testing
        User::create([
            'name'     => 'User Test',
            'email'    => 'user@nursteps.com',
            'password' => Hash::make('password'),
            'role_id'  => $user->id,
        ]);

        // Buat user pro untuk testing
        User::create([
            'name'     => 'Pro Test',
            'email'    => 'pro@nursteps.com',
            'password' => Hash::make('password'),
            'role_id'  => $pro->id,
        ]);
    }
}