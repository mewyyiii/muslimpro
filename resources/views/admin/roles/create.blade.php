@extends('layouts.admin')

@section('title', 'Tambah Peran')

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
            <h1 class="text-2xl font-bold text-gray-800">Tambah Peran</h1>
            <p class="text-sm text-gray-500 mt-0.5">Buat peran baru untuk pengguna</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow p-6">

        <form action="{{ route('admin.roles.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Nama Peran
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="contoh: kasir, moderator, super_admin"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('name') border-red-400 @enderror"
                />
                <p class="text-xs text-gray-400 mt-1.5">Gunakan huruf kecil dan garis bawah saja. Contoh: <code class="bg-gray-100 px-1 rounded">kasir</code>, <code class="bg-gray-100 px-1 rounded">super_admin</code></p>
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
                    Simpan Peran
                </button>
            </div>
        </form>
    </div>

</div>
@endsection