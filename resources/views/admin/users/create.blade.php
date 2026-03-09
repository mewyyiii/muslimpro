@extends('layouts.admin')

@section('title', 'Tambah User')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.users.index') }}"
           class="text-gray-400 hover:text-teal-600 transition text-lg">←</a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Tambah User</h1>
            <p class="text-sm text-gray-500 mt-0.5">Buat akun pengguna baru</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            {{-- Nama --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    placeholder="Masukkan nama lengkap"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('name') border-red-400 @enderror"/>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    placeholder="contoh@email.com"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('email') border-red-400 @enderror"/>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                <input type="password" name="password"
                    placeholder="Minimal 8 karakter"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('password') border-red-400 @enderror"/>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                <input type="password" name="password_confirmation"
                    placeholder="Ulangi password"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300"/>
            </div>

            {{-- Role — dari tabel roles --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Role</label>
                <select name="role_id"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('role_id') border-red-400 @enderror">
                    <option value="">-- Pilih Role --</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                    @endforeach
                </select>
                @error('role_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                <a href="{{ route('admin.users.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-teal-600 hover:bg-teal-700 rounded-xl transition">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection