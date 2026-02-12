@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-500 py-8 md:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ══════════════════════════════════════════════
             HEADER
        ══════════════════════════════════════════════ --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg mb-2">
                👤 Profil Saya
            </h1>
            <p class="text-white/80 text-base md:text-lg">Kelola informasi akun dan pantau ibadahmu</p>
        </div>

        {{-- ══════════════════════════════════════════════
             AVATAR + INFO CARD
        ══════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 mb-6">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">

                {{-- Avatar --}}
                <div class="relative flex-shrink-0" x-data="avatarUploader()">
                    <div class="w-24 h-24 md:w-32 md:h-32 rounded-2xl overflow-hidden ring-4 ring-teal-100 shadow-lg">
                        <img id="avatar-preview"
                                src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('images/default-avatar.png') }}"
                                alt="{{ $user->name }}"
                                class="w-full h-full object-cover">
                    </div>
                    {{-- Tombol upload --}}
                    <label for="avatar-input"
                           class="absolute -bottom-2 -right-2 w-8 h-8 bg-teal-500 hover:bg-teal-600 text-white rounded-full flex items-center justify-center cursor-pointer shadow-md transition-colors"
                           title="Ganti foto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </label>
                  <input type="file"
                    id="avatar-input"
                    name="avatar"
                    form="profile-form"
                    accept="image/*"
                    class="hidden"
                    @change="preview($event)">
                    <p x-show="changed" class="mt-3 text-xs text-teal-600 text-center font-medium">Simpan untuk update</p>
                </div>

                {{-- Info user --}}
                <div class="text-center sm:text-left flex-1">
                    <h2 class="text-2xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-gray-500 mt-1">{{ $user->email }}</p>
                    <p class="text-xs text-gray-400 mt-1">
                        Bergabung {{ $user->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                    </p>

                    {{-- Badge streak --}}
                    @if($streak > 0)
                    <div class="mt-3 inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 border border-amber-200 rounded-full">
                        <span class="text-base">🔥</span>
                        <span class="text-sm font-semibold text-amber-700">{{ $streak }} hari streak shalat</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════
             STATISTIK IBADAH
        ══════════════════════════════════════════════ --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mb-6">
            {{-- Shalat bulan ini --}}
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center col-span-2">
                <div class="flex items-center justify-between mb-2">
                    <span class="text-sm font-semibold text-gray-600 flex items-center gap-1.5">
                        🕌 Shalat Bulan Ini
                    </span>
                    <a href="{{ route('prayer-tracking.index') }}"
                       class="text-xs text-teal-600 hover:underline font-medium">Detail →</a>
                </div>
                <div class="flex items-end gap-2 mb-2">
                    <span class="text-3xl font-bold text-teal-600">{{ $prayerPerformed }}</span>
                    <span class="text-sm text-gray-400 mb-1">/ {{ $prayerTotal }} target</span>
                </div>
                <div class="h-2.5 bg-gray-100 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-teal-400 to-emerald-500 rounded-full transition-all duration-700"
                         style="width: {{ $prayerPercent }}%"></div>
                </div>
                <p class="text-xs text-gray-400 mt-1.5">{{ $prayerPercent }}% tercapai</p>
            </div>

            {{-- Streak --}}
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center">
                <div class="text-3xl font-bold text-amber-500 mb-1">{{ $streak }} 🔥</div>
                <div class="text-xs text-gray-500 font-medium">Hari Berturut</div>
                <div class="text-xs text-amber-400 mt-1">{{ $streak > 0 ? 'Luar biasa!' : 'Mulai sekarang' }}</div>
            </div>

            {{-- Al-Quran (placeholder) --}}
            <div class="bg-white rounded-2xl p-4 shadow-xl text-center relative overflow-hidden">
                <span class="absolute top-2 right-2 px-2 py-0.5 bg-gray-200 text-gray-500 rounded-full text-xs font-semibold">Segera</span>
                <div class="text-3xl font-bold text-gray-300 mb-1">📖</div>
                <div class="text-xs text-gray-400 font-medium">Baca Al-Quran</div>
                <div class="text-xs text-gray-300 mt-1">Coming soon</div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════════
             FORM UPDATE PROFIL
        ══════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600">✏️</span>
                Informasi Profil
            </h3>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data"
                  id="profile-form">
                @csrf
                @method('patch')

                {{-- Hidden avatar input (dari preview) --}}
                {{-- <input type="file" name="avatar" id="avatar-form-input" class="hidden"> --}}

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    {{-- Nama --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Nama Lengkap
                        </label>
                        <input type="text"
                               id="name"
                               name="name"
                               value="{{ old('name', $user->name) }}"
                               required autofocus autocomplete="name"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-gray-800
                                      focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent
                                      transition-all duration-200 bg-gray-50 focus:bg-white
                                      @error('name') border-red-400 @enderror">
                        @error('name')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Alamat Email
                        </label>
                        <input type="email"
                               id="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               required autocomplete="username"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-gray-800
                                      focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent
                                      transition-all duration-200 bg-gray-50 focus:bg-white
                                      @error('email') border-red-400 @enderror">
                        @error('email')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-2 p-2.5 bg-amber-50 border border-amber-200 rounded-lg">
                                <p class="text-xs text-amber-700">
                                    Email belum diverifikasi.
                                    <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="inline">
                                        @csrf
                                    </form>
                                    <button form="send-verification"
                                            class="underline font-semibold hover:text-amber-900">
                                        Kirim ulang email verifikasi
                                    </button>
                                </p>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-1 text-xs text-green-600 font-medium">Link verifikasi sudah dikirim!</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold rounded-xl
                                   shadow hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0">
                        Simpan Perubahan
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }"
                           x-show="show"
                           x-transition
                           x-init="setTimeout(() => show = false, 3000)"
                           class="text-sm text-teal-600 font-medium flex items-center gap-1">
                            ✅ Profil berhasil diperbarui!
                        </p>
                    @endif
                </div>
            </form>
        </div>

        {{-- ══════════════════════════════════════════════
             FORM GANTI PASSWORD
        ══════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 mb-6">
            <h3 class="text-lg font-bold text-gray-800 mb-5 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-teal-100 flex items-center justify-center text-teal-600">🔒</span>
                Ganti Password
            </h3>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                    {{-- Password lama --}}
                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Password Lama
                        </label>
                        <input type="password"
                               id="current_password"
                               name="current_password"
                               autocomplete="current-password"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-gray-800
                                      focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent
                                      transition-all duration-200 bg-gray-50 focus:bg-white
                                      @error('current_password', 'updatePassword') border-red-400 @enderror">
                        @error('current_password', 'updatePassword')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password baru --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Password Baru
                        </label>
                        <input type="password"
                               id="password"
                               name="password"
                               autocomplete="new-password"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-gray-800
                                      focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent
                                      transition-all duration-200 bg-gray-50 focus:bg-white
                                      @error('password', 'updatePassword') border-red-400 @enderror">
                        @error('password', 'updatePassword')
                            <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Konfirmasi --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Konfirmasi Password
                        </label>
                        <input type="password"
                               id="password_confirmation"
                               name="password_confirmation"
                               autocomplete="new-password"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-gray-800
                                      focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-transparent
                                      transition-all duration-200 bg-gray-50 focus:bg-white">
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-teal-500 to-emerald-500 text-white font-semibold rounded-xl
                                   shadow hover:shadow-md transition-all duration-200 hover:-translate-y-0.5 active:translate-y-0">
                        Update Password
                    </button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }"
                           x-show="show"
                           x-transition
                           x-init="setTimeout(() => show = false, 3000)"
                           class="text-sm text-teal-600 font-medium">
                            ✅ Password berhasil diperbarui!
                        </p>
                    @endif
                </div>
            </form>
        </div>

        {{-- ══════════════════════════════════════════════
             DANGER ZONE - HAPUS AKUN
        ══════════════════════════════════════════════ --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border border-red-100"
             x-data="{ showDeleteModal: false }">
            <h3 class="text-lg font-bold text-gray-800 mb-2 flex items-center gap-2">
                <span class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center text-red-500">⚠️</span>
                Hapus Akun
            </h3>
            <p class="text-sm text-gray-500 mb-4">
                Setelah akun dihapus, semua data akan dihapus permanen. Pastikan kamu sudah mengunduh data yang diperlukan.
            </p>
            <button @click="showDeleteModal = true"
                    class="px-5 py-2.5 bg-red-50 hover:bg-red-100 border border-red-200 text-red-600 font-semibold rounded-xl
                           transition-all duration-200 text-sm">
                Hapus Akun Saya
            </button>

            {{-- Modal konfirmasi hapus --}}
            <div x-show="showDeleteModal"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
                 @click.self="showDeleteModal = false">

                <div x-show="showDeleteModal"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="bg-white rounded-2xl shadow-2xl p-6 md:p-8 w-full max-w-md">

                    <div class="text-center mb-6">
                        <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-800 mb-1">Hapus Akun?</h4>
                        <p class="text-sm text-gray-500">
                            Semua data termasuk riwayat shalat akan terhapus permanen dan tidak bisa dikembalikan.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-4">
                            <label for="delete-password" class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Masukkan password untuk konfirmasi
                            </label>
                            <input type="password"
                                   id="delete-password"
                                   name="password"
                                   placeholder="Password kamu"
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200
                                          focus:outline-none focus:ring-2 focus:ring-red-400
                                          bg-gray-50 focus:bg-white transition-all duration-200
                                          @error('password', 'userDeletion') border-red-400 @enderror">
                            @error('password', 'userDeletion')
                                <p class="mt-1.5 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex gap-3">
                            <button type="button"
                                    @click="showDeleteModal = false"
                                    class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors text-sm">
                                Batal
                            </button>
                            <button type="submit"
                                    class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-colors text-sm shadow">
                                Ya, Hapus Akun
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Auto-open modal jika ada error userDeletion --}}
            @if($errors->userDeletion->isNotEmpty())
                <script>
                    document.addEventListener('alpine:init', () => {
                        // trigger open modal jika ada error
                        setTimeout(() => {
                            document.querySelector('[x-data*="showDeleteModal"]').__x.$data.showDeleteModal = true;
                        }, 100);
                    });
                </script>
            @endif
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
function avatarUploader() {
    return {
        changed: false,
        preview(event) {
            const file = event.target.files[0];
            if (!file) {
                this.changed = false;
                return;
            }
            this.changed = true;
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('avatar-preview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    };
}
</script>
@endpush

@push('styles')
<style>
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.15);
    }
</style>
@endpush