@extends('layouts.admin')

@section('title', 'Tambah Iklan')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.ads.index') }}" class="text-gray-400 hover:text-teal-600 transition">
            <svg style="width:20px;height:20px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
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
                            <div style="display:flex;justify-content:center;margin-bottom:8px;color:#9ca3af;">
                                <svg style="width:40px;height:40px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
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
                        'all'             => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Semua Halaman',
                        'home'            => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg> Home',
                        'quran'           => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="currentColor" viewBox="0 0 100 100"><path d="M48 52 C44 46 36 36 24 27 C17 22 8 19 5 22 C2 25 5 31 12 36 C24 43 38 50 47 55 Z"/><path d="M52 52 C56 46 64 36 76 27 C83 22 92 19 95 22 C98 25 95 31 88 36 C76 43 62 50 53 55 Z"/><path d="M47 55 C48 51 49 48 50 46 C51 48 52 51 53 55 C51 56 49 56 47 55 Z"/><path d="M16 85 C19 81 24 75 31 68 C36 63 41 59 45 56 L47 55 L50 57 C47 59 43 63 38 68 C31 75 26 81 23 85 Z"/><path d="M84 85 C81 81 76 75 69 68 C64 63 59 59 55 56 L53 55 L50 57 C53 59 57 63 62 68 C69 75 74 81 77 85 Z"/><ellipse cx="50" cy="58" rx="7" ry="4.5"/></svg> Al-Quran',
                        'tasbih'          => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg> Tasbih',
                        'prayer-tracking' => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="currentColor" viewBox="0 0 463 463"><path d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45c-29.019-38.692-68.521-59.229-114.27-59.44c-6.534-1.114-56.24-8.741-81.407,12.237c-9.696,8.083-14.613,19.147-14.613,32.886c0,20.927,28.343,64.929,43.219,86.583H108.78c-2.546,0-7.078-2.654-11.076-4.997c-6.04-3.538-12.887-7.548-20.285-7.548c-18.66,0-19.558,25.105-20.04,38.594c-0.161,4.508-1.549,8.055-3.018,11.81c-1.602,4.096-3.259,8.331-3.259,13.547c0,5.921,3.306,11.342,9.07,14.873c5.603,3.432,13.516,5.172,23.519,5.172c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5c-1.374,0-2.627-0.047-3.813-0.118c3.929-7.999,9.833-13.734,12.735-16.243h12.241l2.743,24.689c0.422,3.798,3.633,6.672,7.454,6.672H221.68c5.604,0,10.723-2.208,14.804-6.385c6.74-6.899,9.872-18.609,11.318-28.744c17.999,21.989,30.988,32.73,31.86,33.441c1.349,1.1,3.025,1.688,4.739,1.688c0.43,0,0.862-0.037,1.292-0.112c2.145-0.375,4.02-1.663,5.139-3.529l0.003-0.005c3.584,2.37,7.781,3.646,12.176,3.646h94.291c3.353,0,6.298-2.225,7.214-5.45C404.979,317.696,415.638,279.012,397.886,238.967z"/></svg> Prayer Tracking',
                        'asmaul-husna'    => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg> Asmaul Husna',
                        'doa-pendek'      => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg> Doa Pendek',
                        'qibla'           => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg> Qibla',
                    ] as $value => $label)
                    <label class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-2.5 cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition text-sm" style="display:flex;align-items:center;">
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
                class="w-full bg-gradient-to-r from-teal-600 to-emerald-500 hover:from-teal-700 hover:to-emerald-600 text-white font-semibold py-3 rounded-2xl transition shadow-md" style="display:flex;align-items:center;justify-content:center;gap:8px;">
                <svg style="width:18px;height:18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                </svg>
                Simpan Iklan
            </button>

        </form>
    </div>

</div>
@endsection