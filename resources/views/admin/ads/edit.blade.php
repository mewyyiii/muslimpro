@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-2xl mx-auto">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('admin.ads.index') }}"
               class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h1 class="text-xl font-bold text-gray-800">Edit Iklan</h1>
        </div>

        <div class="bg-white rounded-2xl shadow-sm p-6">
            <form action="{{ route('admin.ads.update', $ad) }}"
                  method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                {{-- Validation errors --}}
                @if($errors->any())
                <div class="p-3 bg-red-50 border border-red-200 rounded-xl text-sm text-red-600">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- Judul --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Judul Iklan <span class="text-red-400">*</span>
                    </label>
                    <input type="text" name="title"
                           value="{{ old('title', $ad->title) }}"
                           placeholder="misal: Toko Buku Islam Al-Azhar"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400">
                </div>

                {{-- Gambar --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Gambar Banner
                    </label>
                    @if($ad->image_path)
                        <div class="mb-2">
                            <img src="{{ $ad->image_url }}" class="h-20 rounded-xl object-cover border border-gray-200">
                            <p class="text-xs text-gray-400 mt-1">Upload gambar baru untuk mengganti</p>
                        </div>
                    @endif
                    <input type="file" name="image" accept="image/*"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 file:mr-3 file:py-1 file:px-3 file:rounded-lg file:border-0 file:bg-teal-50 file:text-teal-600 file:text-xs file:font-semibold">
                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP. Maks 2MB. Kosongkan jika tidak ingin mengganti gambar.</p>
                </div>

                {{-- URL --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        URL Tujuan (saat diklik)
                    </label>
                    <input type="url" name="url"
                           value="{{ old('url', $ad->url) }}"
                           placeholder="https://contoh.com"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400 focus:border-teal-400">
                    <p class="text-xs text-gray-400 mt-1">Kosongkan jika iklan tidak perlu diklik</p>
                </div>

                {{-- Posisi --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Posisi Iklan <span class="text-red-400">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="position" value="footer_sticky"
                                   {{ old('position', $ad->position) === 'footer_sticky' ? 'checked' : '' }}
                                   class="peer sr-only">
                            <div class="p-3 border-2 border-gray-200 rounded-xl peer-checked:border-teal-400 peer-checked:bg-teal-50 transition-all">
                                <p class="font-semibold text-sm text-gray-700">📌 Footer Sticky</p>
                                <p class="text-xs text-gray-400 mt-0.5">Menempel di bawah layar</p>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="position" value="in_content"
                                   {{ old('position', $ad->position) === 'in_content' ? 'checked' : '' }}
                                   class="peer sr-only">
                            <div class="p-3 border-2 border-gray-200 rounded-xl peer-checked:border-teal-400 peer-checked:bg-teal-50 transition-all">
                                <p class="font-semibold text-sm text-gray-700">📄 In-Content</p>
                                <p class="text-xs text-gray-400 mt-0.5">Di antara konten halaman</p>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Halaman --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                        Tampilkan di Halaman
                    </label>
                    <div class="grid grid-cols-3 gap-2">
                        @php
                            $pageOptions = [
                                'all'             => 'Semua Halaman',
                                'home'            => 'Home',
                                'quran'           => 'Al-Quran',
                                'shalat'          => 'Shalat',
                                'quran_tracking'  => 'Tracking Quran',
                                'prayer_tracking' => 'Tracking Shalat',
                                'tasbih'          => 'Tasbih',
                                'doa'             => 'Doa',
                                'asmaul_husna'    => 'Asmaul Husna',
                                'qibla'           => 'Kiblat',
                            ];
                            $selectedPages = old('pages', $ad->pages ?? ['all']);
                        @endphp
                        @foreach($pageOptions as $val => $label)
                        <label class="flex items-center gap-2 text-sm cursor-pointer">
                            <input type="checkbox" name="pages[]" value="{{ $val }}"
                                   {{ in_array($val, (array)$selectedPages) ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-teal-500 focus:ring-teal-400 w-4 h-4">
                            <span class="text-gray-700">{{ $label }}</span>
                        </label>
                        @endforeach
                    </div>
                </div>

                {{-- Jadwal --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mulai Tayang</label>
                        <input type="datetime-local" name="starts_at"
                               value="{{ old('starts_at', $ad->starts_at ? $ad->starts_at->format('Y-m-d\TH:i') : '') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan = langsung aktif</p>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Berakhir</label>
                        <input type="datetime-local" name="ends_at"
                               value="{{ old('ends_at', $ad->ends_at ? $ad->ends_at->format('Y-m-d\TH:i') : '') }}"
                               class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan = tidak ada batas</p>
                    </div>
                </div>

                {{-- Status --}}
                <div class="flex items-center gap-3">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" id="is_active"
                           {{ old('is_active', $ad->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-teal-500 focus:ring-teal-400 w-4 h-4">
                    <label for="is_active" class="text-sm font-semibold text-gray-700 cursor-pointer">
                        Aktifkan iklan ini
                    </label>
                </div>

                {{-- Submit --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="flex-1 py-3 bg-teal-500 hover:bg-teal-600 text-white font-bold rounded-xl shadow transition-colors">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.ads.index') }}"
                       class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-semibold rounded-xl transition-colors">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection