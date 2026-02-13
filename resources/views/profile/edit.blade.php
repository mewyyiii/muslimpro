@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-400 via-teal-500 to-emerald-500 py-8 md:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- HEADER --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg mb-2">
                Profil Saya
            </h1>
            <p class="text-white/90 text-base md:text-lg">Kelola informasi akun dan pantau ibadahmu</p>
        </div>

        {{-- MAIN PROFILE CARD --}}
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-6">
            
            {{-- Header Gradient Section --}}
            <div class="bg-gradient-to-br from-teal-400 to-emerald-500 px-6 md:px-8 pt-8 pb-20 relative">
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/10 rounded-full -ml-24 -mb-24"></div>
            </div>

            {{-- Avatar Section (Overlapping) --}}
            <div class="relative px-6 md:px-8 -mt-16 pb-6">
                <div class="flex flex-col items-center" x-data="avatarUploader()">
                    
                    {{-- Avatar Container --}}
                    <div class="relative mb-4">
                        <div class="w-32 h-32 rounded-full overflow-hidden ring-4 ring-white shadow-xl">
                            <img id="avatar-preview"
                                 src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=14b8a6&color=fff&size=256' }}"
                                 alt="{{ $user->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        
                        {{-- Edit Button --}}
                        <label for="avatar-input"
                               class="absolute bottom-0 right-0 w-10 h-10 bg-teal-500 hover:bg-teal-600 text-white rounded-full flex items-center justify-center cursor-pointer shadow-lg transition-all hover:scale-110"
                               title="Ganti foto">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </label>
                        
                        {{-- Delete Button --}}
                        @if($user->avatar)
                        <button type="button"
                                @click="showDeleteAvatarModal = true"
                                class="absolute -top-1 -right-1 w-8 h-8 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-lg transition-all hover:scale-110"
                                title="Hapus foto">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        @endif

                        <input type="file"
                               id="avatar-input"
                               name="avatar"
                               form="profile-form"
                               accept="image/*"
                               class="hidden"
                               @change="preview($event)">
                    </div>

                    {{-- User Info --}}
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">{{ $user->name }}</h2>
                    <p class="text-gray-500 mb-1">{{ $user->email }}</p>
                    <p class="text-xs text-gray-400 mb-3">
                        📅 Bergabung {{ $user->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                    </p>

                    <p x-show="changed" x-transition class="text-sm text-teal-600 font-medium mb-3">
                        💾 Simpan perubahan untuk update foto
                    </p>

                    @if($streak > 0)
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-amber-400 to-orange-400 text-white rounded-full shadow-lg">
                        <span class="text-lg">🔥</span>
                        <span class="text-sm font-bold">{{ $streak }} Hari Streak!</span>
                    </div>
                    @endif

                    {{-- Modal Hapus Avatar --}}
                    <div x-show="showDeleteAvatarModal"
                         x-transition
                         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                         @click.self="showDeleteAvatarModal = false"
                         style="display: none;">
                        <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-sm text-center">
                            <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </div>
                            <h4 class="text-xl font-bold text-gray-800 mb-2">Hapus Foto Profil?</h4>
                            <p class="text-sm text-gray-500 mb-8">
                                Foto profil akan kembali ke default. Yakin ingin melanjutkan?
                            </p>
                            <div class="flex flex-col gap-3">
                                <form method="POST" action="{{ route('profile.avatar.delete') }}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                            class="w-full px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-colors shadow-md">
                                        Ya, Hapus
                                    </button>
                                </form>
                                <button type="button"
                                        @click="showDeleteAvatarModal = false"
                                        class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if (session('status') === 'avatar-deleted')
            <div x-data="{ show: true }"
                 x-show="show"
                 x-transition
                 x-init="setTimeout(() => show = false, 3000)"
                 class="mb-6 p-4 bg-white rounded-2xl shadow-lg border-l-4 border-green-500 text-green-700 text-sm font-medium flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Foto profil berhasil dihapus!
            </div>
        @endif

        {{-- STATISTIK GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            
            {{-- Shalat Bulan Ini --}}
            <div class="md:col-span-2 bg-white rounded-2xl p-6 shadow-lg">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-xl flex items-center justify-center">
                            <span class="text-xl">🕌</span>
                        </div>
                        <div>
                            <h3 class="text-sm font-bold text-gray-800">Shalat Bulan Ini</h3>
                            <p class="text-xs text-gray-500">Target pencapaian</p>
                        </div>
                    </div>
                    <a href="{{ route('prayer-tracking.index') }}"
                       class="text-xs text-teal-600 hover:text-teal-700 font-semibold flex items-center gap-1 hover:gap-2 transition-all">
                        Detail
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
                
                <div class="flex items-baseline gap-2 mb-3">
                    <span class="text-4xl font-bold bg-gradient-to-r from-teal-600 to-emerald-600 bg-clip-text text-transparent">
                        {{ $prayerPerformed }}
                    </span>
                    <span class="text-lg text-gray-400">/ {{ $prayerTotal }}</span>
                </div>
                
                <div class="relative h-3 bg-gray-100 rounded-full overflow-hidden mb-2">
                    <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-teal-400 via-teal-500 to-emerald-500 rounded-full transition-all duration-700 shadow-lg"
                         style="width: {{ $prayerPercent }}%"></div>
                </div>
                
                <p class="text-xs text-gray-500">
                    <span class="font-semibold text-teal-600">{{ $prayerPercent }}%</span> tercapai
                </p>
            </div>

            {{-- Streak Card --}}
            <div class="bg-gradient-to-br from-amber-400 to-orange-400 rounded-2xl p-6 shadow-lg text-white relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-12 -mt-12"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-2xl">🔥</span>
                        <h3 class="text-sm font-bold">Streak</h3>
                    </div>
                    <div class="text-4xl font-bold mb-1">{{ $streak }}</div>
                    <p class="text-sm text-white/90">Hari berturut-turut</p>
                    <p class="text-xs text-white/75 mt-2">
                        {{ $streak > 0 ? '💪 Pertahankan!' : '🚀 Mulai sekarang' }}
                    </p>
                </div>
            </div>

        </div>

        {{-- Al-Quran Widget (jika ada) --}}
        @include('profile.partials.quran-widget')

        {{-- INFORMASI PROFIL CARD --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-6">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Informasi Profil</h3>
                    <p class="text-xs text-gray-500">Update data diri Anda</p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profile-form">
                @csrf
                @method('patch')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                               required autofocus autocomplete="name"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-gray-800
                                      focus:outline-none focus:border-teal-400 transition-all duration-200
                                      @error('name') border-red-400 @enderror">
                        @error('name')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alamat Email
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                               required autocomplete="username"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-gray-800
                                      focus:outline-none focus:border-teal-400 transition-all duration-200
                                      @error('email') border-red-400 @enderror">
                        @error('email')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                            <div class="mt-3 p-3 bg-amber-50 border border-amber-200 rounded-xl">
                                <p class="text-xs text-amber-700 flex items-start gap-2">
                                    <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span>
                                        Email belum diverifikasi.
                                        <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="inline">
                                            @csrf
                                        </form>
                                        <button form="send-verification"
                                                class="underline font-semibold hover:text-amber-900">
                                            Kirim ulang email verifikasi
                                        </button>
                                    </span>
                                </p>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 text-xs text-green-600 font-medium flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Link verifikasi sudah dikirim!
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0">
                        Simpan Perubahan
                    </button>

                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }"
                           x-show="show"
                           x-transition
                           x-init="setTimeout(() => show = false, 3000)"
                           class="text-sm text-teal-600 font-semibold flex items-center gap-2 bg-teal-50 px-4 py-2 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Profil berhasil diperbarui!
                        </p>
                    @endif
                </div>
            </form>
        </div>

        {{-- GANTI PASSWORD CARD --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-6">
            <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-400 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Ganti Password</h3>
                    <p class="text-xs text-gray-500">Perbarui kata sandi Anda</p>
                </div>
            </div>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('put')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password Lama
                        </label>
                        <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-gray-800
                                      focus:outline-none focus:border-purple-400 transition-all duration-200
                                      @error('current_password', 'updatePassword') border-red-400 @enderror">
                        @error('current_password', 'updatePassword')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            Password Baru
                        </label>
                        <input type="password" id="password" name="password" autocomplete="new-password"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-gray-800
                                      focus:outline-none focus:border-purple-400 transition-all duration-200
                                      @error('password', 'updatePassword') border-red-400 @enderror">
                        @error('password', 'updatePassword')
                            <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            Konfirmasi Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 text-gray-800
                                      focus:outline-none focus:border-purple-400 transition-all duration-200">
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                    <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0">
                        Update Password
                    </button>

                    @if (session('status') === 'password-updated')
                        <p x-data="{ show: true }"
                           x-show="show"
                           x-transition
                           x-init="setTimeout(() => show = false, 3000)"
                           class="text-sm text-purple-600 font-semibold flex items-center gap-2 bg-purple-50 px-4 py-2 rounded-lg">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Password berhasil diperbarui!
                        </p>
                    @endif
                </div>
            </form>
        </div>

        {{-- DANGER ZONE --}}
        <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 border-2 border-red-100"
             x-data="{ showDeleteModal: false }">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Hapus Akun</h3>
                    <p class="text-xs text-gray-500">Tindakan permanen dan tidak dapat dibatalkan</p>
                </div>
            </div>
            
            <p class="text-sm text-gray-600 mb-5 leading-relaxed">
                Setelah akun dihapus, semua data termasuk riwayat shalat akan dihapus permanen dan tidak dapat dikembalikan. Pastikan kamu sudah mengunduh data yang diperlukan.
            </p>
            
            <button @click="showDeleteModal = true"
                    class="px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl
                           shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Hapus Akun Saya
            </button>

            {{-- Modal Hapus Akun --}}
            <div x-show="showDeleteModal"
                 x-transition
                 class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm"
                 @click.self="showDeleteModal = false"
                 style="display: none;">
                <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md">
                    <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <h4 class="text-2xl font-bold text-gray-800 mb-3 text-center">Hapus Akun?</h4>
                    <p class="text-sm text-gray-600 mb-6 text-center leading-relaxed">
                        Semua data termasuk riwayat shalat akan terhapus permanen dan tidak bisa dikembalikan. Tindakan ini tidak dapat dibatalkan.
                    </p>

                    <form method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-6">
                            <label for="delete-password" class="block text-sm font-semibold text-gray-700 mb-2">
                                Konfirmasi dengan Password
                            </label>
                            <input type="password" id="delete-password" name="password" placeholder="Masukkan password kamu"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200
                                          focus:outline-none focus:border-red-400 transition-all duration-200
                                          @error('password', 'userDeletion') border-red-400 @enderror">
                            @error('password', 'userDeletion')
                                <p class="mt-2 text-xs text-red-500 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-col gap-3">
                            <button type="submit"
                                    class="w-full px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                Ya, Hapus Akun Selamanya
                            </button>
                            <button type="button"
                                    @click="showDeleteModal = false"
                                    class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if($errors->userDeletion->isNotEmpty())
                <script>
                    document.addEventListener('alpine:init', () => {
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
        showDeleteAvatarModal: false,
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
    /* Smooth focus effects */
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="password"]:focus {
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(20, 184, 166, 0.15);
    }

    /* Gradient text animation */
    @keyframes gradient-shift {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .bg-clip-text {
        background-size: 200% auto;
        animation: gradient-shift 3s ease infinite;
    }

    /* Smooth transitions */
    * {
        transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform, filter, backdrop-filter;
        transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
        transition-duration: 200ms;
    }
</style>
@endpush