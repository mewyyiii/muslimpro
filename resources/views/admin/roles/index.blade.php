@extends('layouts.admin')

@section('title', 'Manage Roles')

@section('content')
<div class="max-w-4xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Manage Roles</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola role dan hak akses pengguna</p>
        </div>
        <a href="{{ route('admin.roles.create') }}"
           class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition flex items-center gap-2">
            + Tambah Role
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl px-4 py-3 mb-6 flex items-center gap-2">
        ✅ {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-6 flex items-center gap-2">
        ⛔ {{ session('error') }}
    </div>
    @endif

    {{-- Info Box --}}
    <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 mb-6 text-sm text-amber-700">
        ⚠️ Role yang masih digunakan oleh user <strong>tidak dapat dihapus</strong>. Role <strong>admin</strong> dilindungi dan tidak bisa dihapus.
    </div>

    {{-- Roles Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @forelse($roles as $role)
        <div class="bg-white rounded-2xl shadow p-5 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                {{-- Icon by role --}}
                <div class="rounded-full p-3 text-xl
                    {{ $role->name === 'admin' ? 'bg-emerald-100' : 'bg-teal-100' }}">
                    {{ $role->name === 'admin' ? '🛡️' : '👤' }}
                </div>
                <div>
                    <p class="font-semibold text-gray-800 capitalize">{{ $role->name }}</p>
                    <p class="text-xs text-gray-400 mt-0.5">
                        {{ $role->users_count }} user
                        @if($role->users_count > 0)
                            <span class="text-teal-600">• aktif</span>
                        @else
                            <span class="text-gray-400">• tidak ada user</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2 flex-shrink-0">
                @if($role->name !== 'admin')
                <a href="{{ route('admin.roles.edit', $role->id) }}"
                   class="text-xs px-3 py-1.5 bg-teal-50 text-teal-700 hover:bg-teal-100 rounded-lg font-medium transition">
                    ✏️ Edit
                </a>
                @endif

                @if($role->name !== 'admin' && $role->users_count === 0)
                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                      onsubmit="return confirm('Yakin hapus role {{ addslashes($role->name) }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="text-xs px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg font-medium transition">
                        🗑️ Hapus
                    </button>
                </form>
                @elseif($role->name === 'admin')
                <span class="text-xs px-3 py-1.5 bg-gray-100 text-gray-400 rounded-lg">
                    🔒 Protected
                </span>
                @else
                <span class="text-xs px-3 py-1.5 bg-gray-100 text-gray-400 rounded-lg"
                      title="Masih ada {{ $role->users_count }} user">
                    🔒 In Use
                </span>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-2 bg-white rounded-2xl shadow p-12 text-center text-gray-400">
            <div class="text-4xl mb-2">🛡️</div>
            <p class="font-medium">Belum ada role</p>
            <p class="text-xs mt-1">Klik "+ Tambah Role" untuk membuat role baru</p>
        </div>
        @endforelse
    </div>

</div>
@endsection