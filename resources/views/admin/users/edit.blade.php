@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.users.index') }}"
           class="text-gray-400 hover:text-teal-600 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Edit Pengguna</h1>
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

            {{-- Password Baru --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                    Sandi Baru
                    <span class="text-gray-400 font-normal">(kosongkan jika tidak diubah)</span>
                </label>
                <div class="relative">
                    <input type="password" id="password" name="password"
                        placeholder="Minimal 8 karakter"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-11 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300 @error('password') border-red-400 @enderror"/>
                    <button type="button" onclick="toggleAdminPass('password', 'eye-password')"
                            class="eye-btn text-gray-400 hover:text-teal-600 transition-colors">
                        <svg id="eye-password" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Konfirmasi Password --}}
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Sandi Baru</label>
                <div class="relative">
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Ulangi sandi baru"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 pr-11 text-sm focus:outline-none focus:ring-2 focus:ring-teal-300"/>
                    <button type="button" onclick="toggleAdminPass('password_confirmation', 'eye-confirm')"
                            class="eye-btn text-gray-400 hover:text-teal-600 transition-colors">
                        <svg id="eye-confirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Role --}}
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
                    <p class="text-amber-500 text-xs mt-1 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z"/>
                        </svg>
                        Tidak bisa mengubah peran akun sendiri
                    </p>
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
                    Perbarui Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    .eye-btn {
        position: absolute !important;
        right: 12px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        background: none;
        border: none;
        cursor: pointer;
        line-height: 0;
        padding: 4px;
    }
    .eye-btn:focus { outline: none; }
    .relative { position: relative; }
    .relative input { transform: none !important; }
</style>
@endpush

@push('scripts')
<script>
function toggleAdminPass(inputId, eyeId) {
    const input = document.getElementById(inputId);
    const eye   = document.getElementById(eyeId);
    const isPassword = input.type === 'password';
    input.type = isPassword ? 'text' : 'password';
    eye.innerHTML = isPassword
        ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
        : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
}
</script>
@endpush