@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<div class="max-w-lg mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.roles.index') }}"
           class="text-gray-400 hover:text-teal-600 transition">
            <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Role</h1>
            <p class="text-sm text-gray-500 mt-0.5">
                Ubah nama role: <span class="font-semibold text-teal-600 capitalize">{{ $role->name }}</span>
            </p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        {{-- Info jumlah user --}}
        @if($userCount > 0)
        <div class="bg-blue-50 border border-blue-200 rounded-xl px-4 py-3 mb-5 text-sm text-blue-700" style="display:flex;align-items:center;gap:8px;">
            <svg style="width:18px;height:18px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Role ini sedang digunakan oleh <strong>{{ $userCount }} user</strong>. Nama role akan ikut berubah.
        </div>
        @endif

        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Nama Role
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $role->name) }}"
                    placeholder="contoh: kasir, moderator, super_admin"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('name') border-red-400 @enderror"
                />
                <p class="text-xs text-gray-400 mt-1.5">Gunakan huruf kecil dan underscore saja.</p>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                <a href="{{ route('admin.roles.index') }}"
                   class="px-5 py-2.5 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition">
                    Batal
                </a>
                <button type="submit"
                        class="px-5 py-2.5 text-sm font-semibold text-white bg-teal-600 hover:bg-teal-700 rounded-xl transition">
                    Update Role
                </button>
            </div>
        </form>
    </div>

</div>
@endsection