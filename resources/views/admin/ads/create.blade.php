@extends('layouts.admin')

@section('title', 'Tambah Iklan')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.ads.index') }}" class="text-gray-400 hover:text-teal-600 transition">←</a>
        <h2 class="text-xl font-bold text-gray-700">Tambah Iklan</h2>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-2xl shadow p-8">
        <form method="POST" action="{{ route('admin.ads.store') }}" enctype="multipart/form-data"
              x-data="{ preview: null, pages: [] }">
            @csrf

            {{-- Judul --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Judul Iklan</label>
                <input type="text" name="title" value="{{ old('title') }}"
                       placeholder="Contoh: Banner Ramadan 2025"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('title')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Upload Gambar --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    Gambar <span class="text-gray-400 font-normal">(maks. 512KB, format: jpg/png/webp)</span>
                </label>
                <div class="border-2 border-dashed border-gray-200 rounded-xl p-6 text-center hover:border-teal-400 transition"
                     @dragover.prevent @drop.prevent="
                        const file = $event.dataTransfer.files[0];
                        preview = URL.createObjectURL(file);
                        $refs.imageInput.files = $event.dataTransfer.files;
                     ">
                    <input type="file" name="image" accept="image/*" x-ref="imageInput"
                           @change="preview = URL.createObjectURL($event.target.files[0])"
                           class="hidden" id="imageInput">

                    <template x-if="!preview">
                        <label for="imageInput" class="cursor-pointer">
                            <p class="text-3xl mb-2">🖼️</p>
                            <p class="text-sm text-gray-500">Klik atau drag & drop gambar di sini</p>
                        </label>
                    </template>

                    <template x-if="preview">
                        <div>
                            <img :src="preview" class="max-h-40 mx-auto rounded-lg object-contain mb-3">
                            <label for="imageInput"
                                   class="text-xs text-teal-600 cursor-pointer hover:underline">
                                Ganti gambar
                            </label>
                        </div>
                    </template>
                </div>
                @error('image')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- URL Tujuan --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">
                    URL Tujuan <span class="text-gray-400 font-normal">(opsional)</span>
                </label>
                <input type="url" name="url" value="{{ old('url') }}"
                       placeholder="https://example.com"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                @error('url')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Posisi --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Posisi</label>
                <select name="position"
                        class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                    <option value="in_content"     {{ old('position') === 'in_content'     ? 'selected' : '' }}>In Content (bawah header)</option>
                    <option value="footer_sticky"  {{ old('position') === 'footer_sticky'  ? 'selected' : '' }}>Footer Sticky (bawah layar)</option>
                </select>
                @error('position')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Halaman --}}
            <div class="mb-8">
                <label class="block text-sm font-medium text-gray-700 mb-2">Tampilkan di Halaman</label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2">
                    @foreach([
                        'all'             => '🌐 Semua Halaman',
                        'home'            => '🏠 Home',
                        'quran'           => '📖 Al-Quran',
                        'tasbih'          => '📿 Tasbih',
                        'prayer-tracking' => '🕌 Prayer Tracking',
                        'asmaul-husna'    => '✨ Asmaul Husna',
                        'doa-pendek'      => '🤲 Doa Pendek',
                        'qibla'           => '🧭 Qibla',
                    ] as $value => $label)
                    <label class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-2.5 cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition text-sm">
                        <input type="checkbox" name="pages[]" value="{{ $value }}"
                               {{ in_array($value, old('pages', [])) ? 'checked' : '' }}
                               class="accent-teal-600">
                        {{ $label }}
                    </label>
                    @endforeach
                </div>
                @error('pages')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-gradient-to-r from-teal-600 to-emerald-500 hover:from-teal-700 hover:to-emerald-600
                       text-white font-semibold py-3 rounded-2xl transition shadow-md">
                💾 Simpan Iklan
            </button>

        </form>
    </div>

</div>
@endsection
