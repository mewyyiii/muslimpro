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
        <svg style="width:20px;height:20px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3 mb-6 flex items-center gap-2">
        <svg style="width:20px;height:20px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- Info Box --}}
    <div class="bg-amber-50 border border-amber-200 rounded-xl px-4 py-3 mb-6 text-sm text-amber-700">
        <svg style="width:18px;height:18px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
        </svg>
        Role yang masih digunakan oleh user <strong>tidak dapat dihapus</strong>. Role <strong>admin</strong> dilindungi dan tidak bisa dihapus.
    </div>

    {{-- Roles Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        @forelse($roles as $role)
        <div class="bg-white rounded-2xl shadow p-5 flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                {{-- Icon by role --}}
                <div class="rounded-full p-3 text-xl
                    {{ $role->name === 'admin' ? 'bg-emerald-100' : 'bg-teal-100' }}">
                    @if($role->name === 'admin')
                        <svg style="width:22px;height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    @else
                        <svg style="width:22px;height:22px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    @endif
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
                   style="display:inline-flex;align-items:center;gap:4px;" class="text-xs px-3 py-1.5 bg-teal-50 text-teal-700 hover:bg-teal-100 rounded-lg font-medium transition">
                    <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Edit
                </a>
                @endif

                @if($role->name !== 'admin' && $role->users_count === 0)
                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST"
                      onsubmit="return confirm('Yakin hapus role {{ addslashes($role->name) }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            style="display:inline-flex;align-items:center;gap:4px;" class="text-xs px-3 py-1.5 bg-red-50 text-red-600 hover:bg-red-100 rounded-lg font-medium transition">
                        <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </form>
                @elseif($role->name === 'admin')
                <span style="display:inline-flex;align-items:center;gap:4px;" class="text-xs px-3 py-1.5 bg-gray-100 text-gray-400 rounded-lg">
                    <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Protected
                </span>
                @else
                <span class="text-xs px-3 py-1.5 bg-gray-100 text-gray-400 rounded-lg"
                      title="Masih ada {{ $role->users_count }} user">
                    <svg style="width:13px;height:13px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    In Use
                </span>
                @endif
            </div>
        </div>
        @empty
        <div class="col-span-2 bg-white rounded-2xl shadow p-12 text-center text-gray-400">
            <div style="display:flex;justify-content:center;margin-bottom:10px;color:#d1d5db;">
                <svg style="width:48px;height:48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <p class="font-medium">Belum ada role</p>
            <p class="text-xs mt-1">Klik "+ Tambah Role" untuk membuat role baru</p>
        </div>
        @endforelse
    </div>

</div>
@endsection