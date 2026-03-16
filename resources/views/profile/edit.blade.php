@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-500 via-emerald-500 to-teal-600 py-8 md:py-12">

    {{-- ── Fixed Sidebar (desktop) ── --}}
    <aside class="profile-sidebar" id="profile-sidebar">
        {{-- Brand --}}
        <div class="sidebar-brand">
            <div class="sidebar-brand-icon">👤</div>
            <div class="sidebar-brand-text">
                Profil Saya
                <div class="sidebar-brand-sub">{{ $user->name }}</div>
            </div>
        </div>

        {{-- Nav --}}
        <div class="sidebar-inner">
            <p class="sidebar-label">Menu</p>
            <nav class="sidebar-nav">
                <a href="#section-shalat"   class="sidebar-item active" data-section="section-shalat">
                    <span class="sidebar-text">Progres Shalat</span>
                </a>
                <a href="#section-quran"    class="sidebar-item" data-section="section-quran">
                    <span class="sidebar-text">Progres Al-Qur'an</span>
                </a>
                <a href="#section-azan"     class="sidebar-item" data-section="section-azan">
                    <span class="sidebar-text">Pengaturan Azan</span>
                </a>
                <a href="#section-profil"   class="sidebar-item" data-section="section-profil">
                    <span class="sidebar-text">Informasi Profil</span>
                </a>
                <a href="#section-password" class="sidebar-item" data-section="section-password">
                    <span class="sidebar-text">Kata Sandi</span>
                </a>
                <a href="#section-danger"   class="sidebar-item sidebar-item-danger" data-section="section-danger">
                    <span class="sidebar-text">Hapus Akun</span>
                </a>
            </nav>
        </div>

        {{-- Footer --}}
        <div class="sidebar-footer"></div>
    </aside>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Page Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Profil Saya</h1>
            <p class="text-white/90 text-base md:text-lg">Kelola informasi akun dan pantau ibadah Anda</p>
        </div>

        {{-- Profile Card - Top Center --}}
        <div class="max-w-md mx-auto mb-8">
            <div class="bg-white/20 backdrop-blur-xl border-2 border-white/30 rounded-3xl p-8 shadow-2xl" x-data="avatarUploader()">
                
                {{-- Avatar Section --}}
                <div class="flex flex-col items-center">
                    <div class="relative mb-4">
                        <div class="w-32 h-32 rounded-full overflow-hidden ring-4 ring-teal-100 shadow-xl bg-gray-100">
                            <img id="avatar-preview"
                                 src="{{ $user->avatar ? asset('storage/'.$user->avatar) : 'https://ui-avatars.com/api/?name='.urlencode($user->name).'&background=14b8a6&color=fff&size=256' }}"
                                 alt="{{ $user->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        
                        {{-- Edit Button --}}
                        <label for="avatar-input"
                               class="absolute bottom-0 right-0 w-10 h-10 bg-teal-500 rounded-full flex items-center justify-center cursor-pointer shadow-lg border-4 border-white hover:bg-teal-600 transition-all transform hover:scale-110"
                               title="Ganti foto">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </label>

                        @if($user->avatar)
                        <button type="button"
                                @click="showDeleteAvatarModal = true"
                                class="absolute top-0 left-0 w-9 h-9 bg-red-500 rounded-full flex items-center justify-center shadow-lg border-4 border-white hover:bg-red-600 transition-all transform hover:scale-110"
                                title="Hapus">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path>
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
                    <h2 class="text-2xl font-bold text-white mb-1">{{ $user->name }}</h2>
                    <p class="text-white/90 mb-1">{{ $user->email }}</p>
                    <p class="text-xs text-white/70">
                        Bergabung sejak {{ $user->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
                    </p>

                    @if (session('status') === 'avatar-deleted')
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-transition
                             x-init="setTimeout(() => show = false, 3000)"
                             class="mt-3 px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-semibold">
                            ✓ Foto profil berhasil dihapus!
                        </div>
                    @endif

                    @if($streak > 0)
                    <div class="mt-4 inline-flex items-center gap-2 bg-gradient-to-r from-orange-400 to-red-500 text-white px-5 py-2.5 rounded-full font-bold shadow-lg">
                        <span class="text-xl">🔥</span>
                        <span>{{ $streak }} Hari Berturut!</span>
                    </div>
                    @endif
                </div>

                {{-- Modal Hapus Avatar --}}
                <div x-show="showDeleteAvatarModal"
                     x-transition
                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
                     @click.self="showDeleteAvatarModal = false"
                     style="display: none;">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-md">
                        <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-3 text-center">Hapus Foto Profil?</h4>
                        <p class="text-gray-600 mb-6 text-center">
                            Foto profil akan kembali ke default. Yakin ingin melanjutkan?
                        </p>
                        <div class="flex flex-col gap-3">
                            <form method="POST" action="{{ route('profile.avatar.delete') }}">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        class="w-full px-6 py-3 bg-teal-500 hover:bg-teal-600 text-white font-bold rounded-2xl transition-all shadow-lg">
                                    Ya, Hapus
                                </button>
                            </form>
                            <button type="button"
                                    @click="showDeleteAvatarModal = false"
                                    class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-2xl transition-colors">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="profile-layout">

            {{-- ── Mobile Tab Bar ── --}}
            <div class="mobile-tabbar" id="mobile-tabbar">
                <a href="#section-shalat"   class="tab-item active" data-section="section-shalat"   title="Progres Shalat">🕌</a>
                <a href="#section-quran"    class="tab-item"        data-section="section-quran"    title="Progres Al-Qur'an">📖</a>
                <a href="#section-azan"     class="tab-item"        data-section="section-azan"     title="Azan">📢</a>
                <a href="#section-profil"   class="tab-item"        data-section="section-profil"   title="Profil">👤</a>
                <a href="#section-password" class="tab-item"        data-section="section-password" title="Kata Sandi">🔒</a>
                <a href="#section-danger"   class="tab-item tab-item-danger" data-section="section-danger" title="Hapus Akun">⚠️</a>
            </div>

            {{-- ── Content ── --}}
            <div class="profile-content space-y-6">

            {{-- Prayer Journey Card --}}
            <div id="section-shalat" class="bg-white rounded-3xl p-6 shadow-2xl scroll-mt-24">
                <div class="flex items-center justify-between mb-5">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-400 to-emerald-500 rounded-2xl flex items-center justify-center shadow-md">
                            <span class="text-2xl">🕌</span>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Progres Shalat</h3>
                            <p class="text-xs text-gray-500">Pantau progres ibadahmu</p>
                        </div>
                    </div>
                    <a href="{{ route('prayer-tracking.index') }}" 
                       class="px-4 py-2 bg-teal-500 hover:bg-teal-600 text-white text-sm font-semibold rounded-xl transition-all shadow-md">
                        Lihat Detail →
                    </a>
                </div>

                {{-- Stats Display --}}
                <div class="bg-gradient-to-br from-teal-400 to-emerald-500 rounded-2xl p-6 text-white shadow-lg mb-4">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-4xl">🕌</span>
                        <div>
                            <div class="text-sm opacity-90">Bulan ini</div>
                            <div class="text-4xl font-bold">{{ $prayerPerformed }}</div>
                        </div>
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div>
                    <div class="flex items-center justify-between text-sm text-gray-700 mb-2">
                        <span class="font-semibold">Target Bulanan</span>
                        <span class="text-lg font-bold text-teal-600">{{ $prayerPercent }}%</span>
                    </div>
                    <div class="h-3 bg-gray-100 rounded-full overflow-hidden shadow-inner">
                        <div class="h-full bg-gradient-to-r from-teal-400 via-emerald-400 to-teal-500 rounded-full transition-all duration-1000"
                             style="width: {{ $prayerPercent }}%"></div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 text-center">{{ $prayerPerformed }} / {{ $prayerTotal }} shalat selesai</p>
                </div>
            </div>

            {{-- Quran Journey Widget --}}
            <div id="section-quran" class="scroll-mt-24">
            @include('profile.partials.quran-widget')
            </div>

            {{-- ★ Pengaturan Azan --}}
            <div id="section-azan" class="scroll-mt-24">
            @include('profile.partials.azan-settings')
            </div>

            {{-- Profile Information Form --}}
            <div id="section-profil" class="bg-white rounded-3xl p-8 shadow-2xl scroll-mt-24">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-400 to-cyan-500 rounded-2xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Informasi Profil</h3>
                        <p class="text-sm text-gray-500">Perbarui detail akun Anda</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profile-form">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                                Nama Lengkap
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                   required autofocus autocomplete="name"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-white text-gray-800 font-medium
                                          focus:outline-none focus:border-teal-400 focus:ring-4 focus:ring-teal-400/20 transition-all
                                          @error('name') border-red-400 @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-bold text-gray-700 mb-2">
                                Alamat Email
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                   required autocomplete="username"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-white text-gray-800 font-medium
                                          focus:outline-none focus:border-teal-400 focus:ring-4 focus:ring-teal-400/20 transition-all
                                          @error('email') border-red-400 @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-3 p-3 bg-amber-50 border-2 border-amber-200 rounded-xl">
                                    <p class="text-sm text-amber-700 font-medium">
                                        Email belum diverifikasi.
                                        <form id="send-verification" method="post" action="{{ route('verification.send') }}" class="inline">
                                            @csrf
                                        </form>
                                        <button form="send-verification"
                                                class="underline font-bold hover:text-amber-900">
                                            Kirim ulang email verifikasi
                                        </button>
                                    </p>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 text-sm text-green-600 font-bold">✓ Link verifikasi sudah dikirim!</p>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-teal-500 to-emerald-500 hover:from-teal-600 hover:to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                            Simpan
                        </button>
                        @if (session('status') === 'profile-updated')
                            <p x-data="{ show: true }"
                               x-show="show"
                               x-transition
                               x-init="setTimeout(() => show = false, 3000)"
                               class="px-4 py-2 bg-emerald-100 text-emerald-700 rounded-xl text-sm font-bold">
                                ✓ Profil berhasil diperbarui!
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Change Password Form --}}
            <div id="section-password" class="bg-white rounded-3xl p-8 shadow-2xl scroll-mt-24">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b-2 border-gray-100">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-pink-500 rounded-2xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Perbarui Kata Sandi</h3>
                        <p class="text-sm text-gray-500">Perbarui keamanan akun anda</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                        {{-- Kata Sandi Saat Ini --}}
                        <div>
                            <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">
                                Kata Sandi Saat Ini
                            </label>
                            <div class="eye-btn-wrap">
                                <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                                       class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-200 bg-white text-gray-800 font-medium
                                              focus:outline-none focus:border-purple-400 focus:ring-4 focus:ring-purple-400/20 transition-all
                                              @error('current_password', 'updatePassword') border-red-400 @enderror">
                                <button type="button"
                                        onclick="togglePass('current_password', 'eye-current')"
                                        class="eye-btn text-gray-400 hover:text-purple-500 transition-colors">
                                    <svg id="eye-current" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('current_password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Kata Sandi Baru --}}
                        <div>
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                                Kata Sandi Baru
                            </label>
                            <div class="eye-btn-wrap">
                                <input type="password" id="password" name="password" autocomplete="new-password"
                                       class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-200 bg-white text-gray-800 font-medium
                                              focus:outline-none focus:border-purple-400 focus:ring-4 focus:ring-purple-400/20 transition-all
                                              @error('password', 'updatePassword') border-red-400 @enderror">
                                <button type="button"
                                        onclick="togglePass('password', 'eye-new')"
                                        class="eye-btn text-gray-400 hover:text-purple-500 transition-colors">
                                    <svg id="eye-new" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                            @error('password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Konfirmasi Kata Sandi --}}
                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">
                                Konfirmasi Kata Sandi
                            </label>
                            <div class="eye-btn-wrap">
                                <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                       class="w-full px-4 py-3 pr-12 rounded-xl border-2 border-gray-200 bg-white text-gray-800 font-medium
                                              focus:outline-none focus:border-purple-400 focus:ring-4 focus:ring-purple-400/20 transition-all">
                                <button type="button"
                                        onclick="togglePass('password_confirmation', 'eye-confirm')"
                                        class="eye-btn text-gray-400 hover:text-purple-500 transition-colors">
                                    <svg id="eye-confirm" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <button type="submit"
                                class="px-8 py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                            Perbarui Sandi
                        </button>

                        @if (session('status') === 'password-updated')
                            <p x-data="{ show: true }"
                               x-show="show"
                               x-transition
                               x-init="setTimeout(() => show = false, 3000)"
                               class="px-4 py-2 bg-purple-100 text-purple-700 rounded-xl text-sm font-bold">
                                ✓ Sandi berhasil diperbarui!
                            </p>
                        @endif
                    </div>
                </form>
            </div>

            {{-- Script toggle password --}}
            <script>
            function togglePass(inputId, eyeId) {
                const input = document.getElementById(inputId);
                const eye   = document.getElementById(eyeId);
                const isPassword = input.type === 'password';
                input.type = isPassword ? 'text' : 'password';
                eye.innerHTML = isPassword
                    ? `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>`
                    : `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>`;
            }
            </script>

            {{-- Danger Zone --}}
            <div id="section-danger" class="bg-white rounded-3xl p-8 shadow-2xl border-2 border-red-200 scroll-mt-24"
                 x-data="{
                     showDeleteModal: {{ $errors->userDeletion->isNotEmpty() ? 'true' : 'false' }},
                     passwordError: '',
                     pwLoading: false,
                     async submitDelete() {
                         const pwd = document.getElementById('delete-password').value.trim();
                         if (!pwd) {
                             this.passwordError = 'Kata sandi wajib diisi untuk konfirmasi.';
                             document.getElementById('delete-password').focus();
                             return;
                         }
                         this.passwordError = '';
                         this.pwLoading = true;
                         try {
                             const res = await fetch('{{ route('profile.destroy.verify') }}', {
                                 method: 'POST',
                                 headers: {
                                     'Content-Type': 'application/json',
                                     'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                     'Accept': 'application/json',
                                 },
                                 body: JSON.stringify({ password: pwd })
                             });
                             const data = await res.json();
                             if (data.valid) {
                                 document.getElementById('real-delete-password').value = pwd;
                                 document.getElementById('real-delete-form').submit();
                             } else {
                                 this.passwordError = 'Kata sandi salah. Silakan coba lagi.';
                                 this.pwLoading = false;
                                 document.getElementById('delete-password').focus();
                             }
                         } catch(e) {
                             this.passwordError = 'Terjadi kesalahan. Silakan coba lagi.';
                             this.pwLoading = false;
                         }
                     }
                 }"
                 x-init="if (showDeleteModal) { $nextTick(() => { document.getElementById('delete-password').focus() }) }">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Hapus Akun</h3>
                        <p class="text-sm text-gray-500">Hapus akun secara permanen</p>
                    </div>
                </div>

                <p class="text-gray-700 mb-6 leading-relaxed">
                    Setelah akun Anda dihapus, semua data termasuk riwayat ibadah akan dihapus secara permanen. Tindakan ini <strong>tidak dapat dibatalkan</strong>.
                </p>

                <button @click="showDeleteModal = true; passwordError = ''"
                        class="px-8 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                    Hapus Akun
                </button>

                {{-- Modal Hapus Akun --}}
                <div x-show="showDeleteModal"
                     x-transition.opacity
                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
                     
                     style="display: none;">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-lg"
                         @click.stop>

                        {{-- Icon --}}
                        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </div>

                        <h4 class="text-2xl font-bold text-gray-800 mb-3 text-center">Hapus Akun?</h4>
                        <p class="text-gray-600 mb-6 text-center leading-relaxed">
                            Semua data termasuk riwayat shalat dan Al-Qur'an akan dihapus permanen dan <strong>tidak dapat dikembalikan</strong>.
                        </p>

                        {{-- Form tersembunyi, hanya disubmit setelah password terverifikasi --}}
                        <form id="real-delete-form" method="POST" action="{{ route('profile.destroy') }}" class="hidden">
                            @csrf
                            @method('delete')
                            <input type="hidden" name="password" id="real-delete-password">
                        </form>

                        <div>

                            <div class="mb-2">
                                <label for="delete-password" class="block text-sm font-bold text-gray-700 mb-2">
                                    Masukkan Kata Sandi untuk Konfirmasi
                                </label>
                                <div class="eye-btn-wrap">
                                    <input type="password"
                                           id="delete-password"
                                           name="password"
                                           placeholder="Kata sandi Anda"
                                           autocomplete="current-password"
                                           @input="if ($event.target.value.trim()) passwordError = ''"
                                           class="w-full px-4 py-3 pr-12 rounded-xl border-2 transition-all
                                                  focus:outline-none focus:ring-4
                                                  {{ $errors->userDeletion->has('password') ? 'border-red-400 focus:border-red-400 focus:ring-red-400/20' : 'border-gray-200 focus:border-red-400 focus:ring-red-400/20' }}"
                                           :class="passwordError ? 'border-red-400 bg-red-50' : ''">
                                    <button type="button" tabindex="-1"
                                            onclick="
                                                const inp = document.getElementById('delete-password');
                                                const eo  = document.getElementById('del-eye-open');
                                                const ec  = document.getElementById('del-eye-closed');
                                                if (inp.type === 'password') {
                                                    inp.type = 'text';
                                                    eo.style.display = 'none';
                                                    ec.style.display = 'block';
                                                } else {
                                                    inp.type = 'password';
                                                    eo.style.display = 'block';
                                                    ec.style.display = 'none';
                                                }
                                            "
                                            class="eye-btn p-1.5 text-gray-400 hover:text-red-500 transition-colors">
                                        <svg id="del-eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                        <svg id="del-eye-closed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display:none;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                        </svg>
                                    </button>
                                </div>

                                {{-- Error dari server (password salah) --}}
                                @error('password', 'userDeletion')
                                    <p class="mt-2 text-sm text-red-600 font-semibold flex items-center gap-1">
                                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        {{ $message }}
                                    </p>
                                @enderror

                                {{-- Error dari client-side (password kosong) --}}
                                <p x-show="passwordError"
                                   x-text="passwordError"
                                   x-transition
                                   class="mt-2 text-sm text-red-600 font-semibold flex items-center gap-1"
                                   style="display:none;">
                                </p>
                            </div>

                            <div class="flex flex-col gap-3 mt-6">
                                <button type="button"
                                        @click="submitDelete()"
                                        :disabled="pwLoading"
                                        :class="pwLoading ? 'opacity-70 cursor-not-allowed' : ''"
                                        class="w-full px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-2xl transition-all shadow-lg flex items-center justify-center gap-2">
                                    <svg x-show="pwLoading" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/>
                                    </svg>
                                    <span x-text="pwLoading ? 'Memverifikasi...' : 'Ya, Hapus Selamanya'"></span>
                                </button>
                                <button type="button"
                                        @click="showDeleteModal = false; passwordError = ''; document.getElementById('delete-password').value = ''"
                                        class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-2xl transition-colors">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>{{-- /.profile-content --}}
        </div>{{-- /.profile-layout --}}

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

// ── Sidebar / Tab active state via IntersectionObserver ──────────
document.addEventListener('DOMContentLoaded', function () {
    const sections = ['section-shalat','section-quran','section-azan','section-profil','section-password','section-danger'];
    const allLinks = document.querySelectorAll('.sidebar-item[data-section], .tab-item[data-section]');

    function setActive(sectionId) {
        allLinks.forEach(link => {
            const isDanger = link.classList.contains('sidebar-item-danger') || link.classList.contains('tab-item-danger');
            link.classList.remove('active');
            if (link.dataset.section === sectionId) {
                link.classList.add('active');
            }
        });
    }

    // Smooth scroll on click
    allLinks.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.getElementById(this.dataset.section);
            if (target) {
                const offset = 90;
                const top = target.getBoundingClientRect().top + window.scrollY - offset;
                window.scrollTo({ top, behavior: 'smooth' });
                setActive(this.dataset.section);
            }
        });
    });

    // IntersectionObserver for scroll spy
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                setActive(entry.target.id);
            }
        });
    }, {
        rootMargin: '-20% 0px -70% 0px',
        threshold: 0
    });

    sections.forEach(id => {
        const el = document.getElementById(id);
        if (el) observer.observe(el);
    });
});
</script>
@endpush

@push('styles')
<style>
    /* ── Profile Sidebar — Full Height Fixed Left ────────────────── */
    .profile-sidebar {
        display: none;
    }

    @media (min-width: 768px) {
        .profile-sidebar {
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            height: 100vh;
            z-index: 35;
            background: linear-gradient(180deg, #0f766e 0%, #065f46 100%);
            box-shadow: 4px 0 24px rgba(0,0,0,0.18);
            overflow-y: auto;
            overflow-x: hidden;
        }
        .profile-sidebar::-webkit-scrollbar { width: 3px; }
        .profile-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 99px; }

        /* Push main content to the right */
        .max-w-4xl { margin-left: 240px !important; margin-right: auto !important; }
    }

    @media (min-width: 768px) and (max-width: 1100px) {
        .profile-sidebar { width: 60px; }
        .sidebar-text   { display: none; }
        .sidebar-label  { display: none; }
        .sidebar-brand  { justify-content: center; padding: 20px 0; }
        .sidebar-brand-text { display: none; }
        .sidebar-item   { justify-content: center; padding: 12px 0; }
        .sidebar-icon   { font-size: 1.3rem; }
        .sidebar-inner  { padding: 8px 6px; }
        .max-w-4xl { margin-left: 80px !important; }
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 24px 18px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.1);
        flex-shrink: 0;
    }
    .sidebar-brand-icon {
        width: 38px; height: 38px;
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    .sidebar-brand-text {
        font-size: 0.85rem;
        font-weight: 700;
        color: #fff;
        line-height: 1.2;
    }
    .sidebar-brand-sub {
        font-size: 0.68rem;
        color: rgba(255,255,255,0.55);
        font-weight: 500;
    }

    .sidebar-inner {
        flex: 1;
        padding: 16px 12px;
        overflow-y: auto;
    }

    .sidebar-label {
        font-size: 0.6rem;
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: rgba(255,255,255,0.45);
        padding: 0 10px;
        margin-bottom: 6px;
        margin-top: 4px;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .sidebar-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 10px;
        text-decoration: none;
        transition: background 0.15s, padding-left 0.15s;
        border: none;
        color: rgba(255,255,255,0.7);
    }
    .sidebar-item:hover {
        background: rgba(255,255,255,0.1);
        color: #fff;
        text-decoration: none;
    }
    .sidebar-item.active {
        background: rgba(255,255,255,0.18);
        color: #fff;
        box-shadow: inset 3px 0 0 #fff;
        padding-left: 14px;
    }
    .sidebar-item-danger       { color: rgba(255,255,255,0.7); }
    .sidebar-item-danger:hover { background: rgba(255,255,255,0.1); color: #fff; }
    .sidebar-item-danger.active { box-shadow: inset 3px 0 0 #fff; background: rgba(255,255,255,0.18); color: #fff; }

    .sidebar-icon { font-size: 1.05rem; line-height: 1; flex-shrink: 0; width: 20px; text-align: center; }
    .sidebar-text {
        font-size: 0.82rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .sidebar-footer {
        padding: 14px 12px;
        border-top: 1px solid rgba(255,255,255,0.1);
        flex-shrink: 0;
    }
    .sidebar-back-link {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border-radius: 10px;
        text-decoration: none;
        color: rgba(255,255,255,0.6);
        font-size: 0.8rem;
        font-weight: 600;
        transition: background 0.15s, color 0.15s;
    }
    .sidebar-back-link:hover { background: rgba(255,255,255,0.08); color: #fff; text-decoration: none; }

    /* ── Mobile Tab Bar ─────────────────────────────────────────── */
    .mobile-tabbar { display: none; }

    @media (max-width: 767px) {
        .mobile-tabbar {
            display: flex;
            align-items: center;
            justify-content: space-around;
            position: sticky;
            top: 60px;
            z-index: 30;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.3);
            border-radius: 16px;
            padding: 8px 6px;
            margin-bottom: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .tab-item {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 42px; height: 42px;
            border-radius: 12px;
            font-size: 1.3rem;
            text-decoration: none;
            transition: background 0.15s, transform 0.15s;
            border: 1px solid transparent;
        }
        .tab-item:hover { background: rgba(255,255,255,0.2); transform: scale(1.1); text-decoration: none; }
        .tab-item.active {
            background: rgba(255,255,255,0.9);
            border-color: rgba(255,255,255,0.5);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transform: scale(1.1);
        }
        .tab-item-danger.active { background: rgba(254,226,226,0.95); }
    }

    * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    button:active {
        transform: translateY(0) !important;
    }

    /* Mencegah icon mata naik-turun saat input focus / click */
    .eye-btn-wrap {
        position: relative;
        transform: none !important;
    }
    .eye-btn-wrap:focus-within {
        transform: none !important;
    }
    .eye-btn {
        position: absolute !important;
        right: 12px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        padding: 6px;
        line-height: 0;
        background: none;
        border: none;
        cursor: pointer;
        pointer-events: auto;
    }
    /* Override button:active agar eye-btn tidak bergerak sama sekali */
    .eye-btn:active,
    .eye-btn-wrap:focus-within .eye-btn,
    .eye-btn-wrap:focus-within .eye-btn:active,
    .eye-btn:focus {
        transform: translateY(-50%) !important;
        outline: none;
    }
    .eye-btn-wrap input {
        transform: none !important;
    }
</style>
@endpush