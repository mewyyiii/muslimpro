@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.users.index') }}"
           class="text-gray-400 hover:text-teal-600 transition text-lg">←</a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit User</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Ubah data: <span class="font-semibold text-teal-600">{{ $user->name }}</span>
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        {{-- Avatar Preview --}}
        <div class="flex items-center gap-4 mb-6 pb-6 border-b border-gray-100">
            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                 class="w-14 h-14 rounded-full object-cover"/>
            <div>
                <p class="font-semibold text-gray-800">{{ $user->name }}</p>
                <p class="text-sm text-gray-400">{{ $user->email }}</p>
                <p class="text-xs text-gray-400 mt-0.5">
                    Bergabung {{ $user->created_at->format('d M Y') }}
                </p>
            </div>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    placeholder="Masukkan nama lengkap"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('name') border-red-400 @enderror"/>
                @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                    placeholder="contoh@email.com"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('email') border-red-400 @enderror"/>
                @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Password Baru
                    <span class="text-gray-400 font-normal">(kosongkan jika tidak diubah)</span>
                </label>
                <input type="password" name="password"
                    placeholder="Minimal 8 karakter"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('password') border-red-400 @enderror"/>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password Baru</label>
                <input type="password" name="password_confirmation"
                    placeholder="Ulangi password baru"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300"/>
            </div>

            {{-- Role — dari tabel roles --}}
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Role</label>
                <select name="role_id"
                    @if($user->id === auth()->id()) disabled @endif
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 disabled:bg-gray-50 disabled:text-gray-400 @error('role_id') border-red-400 @enderror">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>
                        {{ ucfirst($role->name) }}
                    </option>
                    @endforeach
                </select>
                @if($user->id === auth()->id())
                    <p class="text-amber-500 text-xs mt-1">⚠️ Tidak bisa mengubah role akun sendiri</p>
                @endif
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
                    Update User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection