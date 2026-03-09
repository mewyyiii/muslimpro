<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        // Ambil semua role beserta jumlah user-nya
        $roles = Role::withCount('users')->get();

        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.roles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'unique:roles,name', 'regex:/^[a-z_]+$/'],
        ], [
            'name.regex' => 'Nama role hanya boleh huruf kecil dan underscore (contoh: kasir, super_admin)',
        ]);

        Role::create(['name' => strtolower($request->name)]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role "' . $request->name . '" berhasil ditambahkan!');
    }

    public function edit(Role $role)
    {
        // Hitung jumlah user dengan role ini
        $userCount = User::where('role_id', $role->id)->count();
        return view('admin.roles.edit', compact('role', 'userCount'));
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50', Rule::unique('roles')->ignore($role->id), 'regex:/^[a-z_]+$/'],
        ], [
            'name.regex' => 'Nama role hanya boleh huruf kecil dan underscore (contoh: kasir, super_admin)',
        ]);

        $role->update(['name' => strtolower($request->name)]);

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role berhasil diperbarui!');
    }

    public function destroy(Role $role)
    {
        // Cek apakah role masih dipakai user
        $userCount = User::where('role_id', $role->id)->count();

        if ($userCount > 0) {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Role "' . $role->name . '" tidak bisa dihapus karena masih digunakan oleh ' . $userCount . ' user!');
        }

        // Jangan hapus role admin (proteksi)
        if ($role->name === 'admin') {
            return redirect()->route('admin.roles.index')
                ->with('error', 'Role "admin" tidak bisa dihapus!');
        }

        $name = $role->name;
        $role->delete();

        return redirect()->route('admin.roles.index')
            ->with('success', 'Role "' . $name . '" berhasil dihapus!');
    }
}