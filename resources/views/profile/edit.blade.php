@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-teal-500 via-emerald-500 to-teal-600 py-8 md:py-12">
    
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
                        Member Since: {{ $user->created_at->locale('id')->isoFormat('D MMMM YYYY') }}
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

        {{-- Main Content Grid --}}
        <div class="space-y-6">
            
            {{-- Prayer Journey Card --}}
            <div class="bg-white rounded-3xl p-6 shadow-2xl">
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
            @include('profile.partials.quran-widget')

            {{-- Profile Information Form --}}
            <div class="bg-white rounded-3xl p-8 shadow-2xl">
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
                                        ⚠ Email belum diverifikasi.
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
            <div class="bg-white rounded-3xl p-8 shadow-2xl">
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
                        <div>
                            <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">
                                Kata Sandi Saat Ini
                            </label>
                            <input type="password" id="current_password" name="current_password" autocomplete="current-password"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-white text-gray-800 font-medium
                                          focus:outline-none focus:border-purple-400 focus:ring-4 focus:ring-purple-400/20 transition-all
                                          @error('current_password', 'updatePassword') border-red-400 @enderror">
                            @error('current_password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-bold text-gray-700 mb-2">
                                Kata Sandi Baru
                            </label>
                            <input type="password" id="password" name="password" autocomplete="new-password"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-white text-gray-800 font-medium
                                          focus:outline-none focus:border-purple-400 focus:ring-4 focus:ring-purple-400/20 transition-all
                                          @error('password', 'updatePassword') border-red-400 @enderror">
                            @error('password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">
                                Konfirmasi Kata Sandi
                            </label>
                            <input type="password" id="password_confirmation" name="password_confirmation" autocomplete="new-password"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-white text-gray-800 font-medium
                                          focus:outline-none focus:border-purple-400 focus:ring-4 focus:ring-purple-400/20 transition-all">
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

            {{-- Danger Zone --}}
            <div class="bg-white rounded-3xl p-8 shadow-2xl border-2 border-red-200"
                 x-data="{ showDeleteModal: false }">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center shadow-md">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">Hapus Akun</h3>
                        <p class="text-sm text-gray-500">Hapus akun permanen</p>
                    </div>
                </div>
                
                <p class="text-gray-700 mb-6 leading-relaxed">
                    Setelah akun Anda dihapus, semua data Anda termasuk riwayat doa akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.                
                </p>
                <button @click="showDeleteModal = true"
                        class="px-8 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:-translate-y-0.5">
                    Hapus Akun
                </button>

                {{-- Modal Delete Account --}}
                <div x-show="showDeleteModal"
                     x-transition
                     class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
                     @click.self="showDeleteModal = false"
                     style="display: none;">
                    <div class="bg-white rounded-3xl shadow-2xl p-8 w-full max-w-lg">
                        <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-5">
                            <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-bold text-gray-800 mb-3 text-center">Hapus Akun?</h4>
                        <p class="text-gray-600 mb-6 text-center leading-relaxed">
                            Semua data termasuk riwayat shalat akan dihapus permanen dan tidak dapat dikembalikan.
                        </p>

                        <form method="POST" action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="mb-6">
                                <label for="delete-password" class="block text-sm font-bold text-gray-700 mb-2">
                                    Konfirmasi dengan Password
                                </label>
                                <input type="password" id="delete-password" name="password" placeholder="Masukkan password"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 bg-white
                                              focus:outline-none focus:border-red-400 focus:ring-4 focus:ring-red-400/20 transition-all
                                              @error('password', 'userDeletion') border-red-400 @enderror">
                                @error('password', 'userDeletion')
                                    <p class="mt-2 text-sm text-red-600 font-semibold">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex flex-col gap-3">
                                <button type="submit"
                                        class="w-full px-6 py-3 bg-red-500 hover:bg-red-600 text-white font-bold rounded-2xl transition-all shadow-lg">
                                    Ya, Hapus Selamanya
                                </button>
                                <button type="button"
                                        @click="showDeleteModal = false"
                                        class="w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-2xl transition-colors">
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
    * {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    input:focus {
        transform: translateY(-1px);
    }

    button:active {
        transform: translateY(0) !important;
    }
</style>
@endpush