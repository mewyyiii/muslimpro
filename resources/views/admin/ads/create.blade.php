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
                        'quran'           => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="currentColor" viewBox="0 0 484.228 484.228"><path d="M484.06,210.989L438.305,52.856c-0.328-1.133-1.112-2.079-2.164-2.611c-1.054-0.533-2.278-0.605-3.385-0.197l-12.411,4.561l-1.982-6.582c-0.339-1.127-1.131-2.063-2.186-2.584c-1.055-0.522-2.279-0.583-3.381-0.168c-29.582,11.134-44.034,14.763-107.786,22.14c-40.168,4.647-56.44,21.963-62.954,33.842c-6.469-11.884-22.678-29.195-62.839-33.842c-63.753-7.377-78.205-11.006-107.787-22.14c-1.101-0.415-2.326-0.354-3.381,0.168c-1.055,0.521-1.847,1.457-2.186,2.584l-1.976,6.562l-12.423-4.543c-1.105-0.403-2.332-0.331-3.382,0.201c-1.051,0.533-1.833,1.478-2.161,2.609L0.168,210.989c-0.638,2.207,0.593,4.521,2.779,5.226l141.114,45.496l-59.117,47.54c-1.004,0.807-1.587,2.025-1.587,3.312v32.49c0,1.709,1.023,3.252,2.599,3.916c1.574,0.664,3.394,0.32,4.617-0.872l26.274-25.606c4.096-3.976,10.665-3.88,14.64,0.216l5.087,5.24c1.926,1.983,2.964,4.599,2.923,7.364c-0.041,2.765-1.156,5.348-3.15,7.284l-51.71,50.528c-0.818,0.799-1.279,1.896-1.279,3.04v38.814c0,1.698,1.011,3.233,2.569,3.904c0.542,0.233,1.113,0.346,1.68,0.346c1.066,0,2.117-0.401,2.922-1.163l151.508-143.381l151.74,143.383c0.805,0.761,1.855,1.161,2.92,1.161c0.567,0,1.14-0.114,1.681-0.347c1.559-0.671,2.568-2.206,2.568-3.903v-38.814c0-1.144-0.461-2.24-1.279-3.04l-51.722-50.538c-1.983-1.926-3.099-4.509-3.14-7.274c-0.041-2.765,0.997-5.38,2.923-7.364l5.087-5.24c3.976-4.096,10.542-4.193,14.634-0.223l26.281,25.613c1.224,1.192,3.045,1.536,4.617,0.872c1.575-0.664,2.599-2.207,2.599-3.916v-32.49c0-1.286-0.582-2.503-1.583-3.309l-59.081-47.609l140.999-45.429C483.467,215.51,484.697,213.196,484.06,210.989z"/></svg> Al-Quran',
                        'tasbih' => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="currentColor" viewBox="0 0 430 380"><circle cx="200" cy="42" r="18"/><circle cx="228" cy="45" r="18"/><circle cx="255" cy="53" r="18"/><circle cx="280" cy="65" r="18"/><circle cx="302" cy="83" r="18"/><circle cx="321" cy="104" r="18"/><circle cx="335" cy="129" r="18"/><circle cx="344" cy="155" r="18"/><circle cx="348" cy="183" r="18"/><circle cx="346" cy="211" r="18"/><circle cx="340" cy="238" r="18"/><circle cx="328" cy="264" r="18"/><circle cx="312" cy="287" r="18"/><circle cx="291" cy="306" r="18"/><circle cx="268" cy="322" r="18"/><circle cx="242" cy="332" r="18"/><circle cx="214" cy="337" r="18"/><circle cx="186" cy="337" r="18"/><circle cx="158" cy="332" r="18"/><circle cx="132" cy="322" r="18"/><circle cx="109" cy="306" r="18"/><circle cx="88" cy="287" r="18"/><circle cx="72" cy="264" r="18"/><circle cx="60" cy="238" r="18"/><circle cx="54" cy="211" r="18"/><circle cx="52" cy="183" r="18"/><circle cx="56" cy="155" r="18"/><circle cx="65" cy="129" r="18"/><circle cx="79" cy="104" r="18"/><circle cx="98" cy="83" r="18"/><circle cx="120" cy="65" r="18"/><circle cx="145" cy="53" r="18"/><circle cx="172" cy="45" r="18"/><circle cx="354" cy="279" r="10"/><polygon points="359,274 352,286 370,296 377,284"/><polygon points="379,280 367,300 393,315 405,295"/></svg> Tasbih',
                        'prayer-tracking' => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="currentColor" viewBox="0 0 463 463"><path d="M397.886,238.967c-1.202-2.712-3.89-4.46-6.856-4.46h-32.162c-3.413-9.876-12.071-31.572-28.48-53.45c-29.019-38.692-68.521-59.229-114.27-59.44c-6.534-1.114-56.24-8.741-81.407,12.237c-9.696,8.083-14.613,19.147-14.613,32.886c0,20.927,28.343,64.929,43.219,86.583H108.78c-2.546,0-7.078-2.654-11.076-4.997c-6.04-3.538-12.887-7.548-20.285-7.548c-18.66,0-19.558,25.105-20.04,38.594c-0.161,4.508-1.549,8.055-3.018,11.81c-1.602,4.096-3.259,8.331-3.259,13.547c0,5.921,3.306,11.342,9.07,14.873c5.603,3.432,13.516,5.172,23.519,5.172c4.143,0,7.5-3.358,7.5-7.5s-3.357-7.5-7.5-7.5c-1.374,0-2.627-0.047-3.813-0.118c3.929-7.999,9.833-13.734,12.735-16.243h12.241l2.743,24.689c0.422,3.798,3.633,6.672,7.454,6.672H221.68c5.604,0,10.723-2.208,14.804-6.385c6.74-6.899,9.872-18.609,11.318-28.744c17.999,21.989,30.988,32.73,31.86,33.441c1.349,1.1,3.025,1.688,4.739,1.688c0.43,0,0.862-0.037,1.292-0.112c2.145-0.375,4.02-1.663,5.139-3.529l0.003-0.005c3.584,2.37,7.781,3.646,12.176,3.646h94.291c3.353,0,6.298-2.225,7.214-5.45C404.979,317.696,415.638,279.012,397.886,238.967z"/></svg> Prayer Tracking',
                        'asmaul-husna'    => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg> Asmaul Husna',
                        'doa-pendek'      => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg> Doa Pendek',
                        'qibla' => '<svg style="width:14px;height:14px;flex-shrink:0;" fill="currentColor" viewBox="0 0 338.605 338.605"><g><path d="M169.303,0.001C75.949,0.001,0,75.949,0,169.303s75.949,169.302,169.303,169.302s169.303-75.949,169.303-169.302S262.656,0.001,169.303,0.001z M169.303,320c-83.095,0-150.697-67.603-150.697-150.698S86.208,18.605,169.303,18.605S320,86.208,320,169.303S252.397,320,169.303,320z"/><path d="M169.303,27.22C90.958,27.22,27.22,90.958,27.22,169.303s63.738,142.083,142.083,142.083s142.083-63.738,142.083-142.083S247.647,27.22,169.303,27.22z M301.309,189.066l-9.702-1.71l-1.201,6.816l9.708,1.711c-1.095,5.393-2.516,10.668-4.24,15.805l-9.258-3.369l-2.367,6.504l9.255,3.369c-2.015,5.1-4.335,10.046-6.939,14.817l-8.509-4.912l-3.459,5.994l8.494,4.903c-2.863,4.657-6.005,9.124-9.399,13.382l-7.492-6.286l-4.449,5.302l7.486,6.282c-3.615,4.085-7.477,7.946-11.561,11.562l-6.286-7.488l-5.301,4.449l6.29,7.493c-4.258,3.396-8.726,6.538-13.384,9.401l-4.901-8.492l-5.994,3.46l4.909,8.506c-4.771,2.603-9.718,4.924-14.818,6.939l-3.369-9.254l-6.504,2.368l3.37,9.255c-5.138,1.725-10.412,3.146-15.805,4.24l-1.714-9.705l-6.816,1.203l1.713,9.698c-5.339,0.796-10.777,1.28-16.301,1.421v-26.382h-6.922v26.382c-5.523-0.141-10.964-0.625-16.303-1.421l1.714-9.697l-6.814-1.204l-1.716,9.705c-5.393-1.094-10.668-2.515-15.806-4.24l3.371-9.254l-6.502-2.369l-3.371,9.254c-5.101-2.015-10.046-4.336-14.818-6.939l4.91-8.506l-5.994-3.46l-4.901,8.492c-4.658-2.863-9.126-6.005-13.384-9.401l6.288-7.493l-5.301-4.449l-6.284,7.488c-4.085-3.616-7.946-7.477-11.562-11.562l7.486-6.282l-4.449-5.302l-7.492,6.286c-3.395-4.257-6.537-8.725-9.399-13.382l8.494-4.902l-3.459-5.994l-8.509,4.911c-2.604-4.771-4.925-9.717-6.939-14.817l9.254-3.368l-2.367-6.504l-9.256,3.369c-1.725-5.137-3.146-10.412-4.24-15.805l9.708-1.711l-1.201-6.816l-9.702,1.71c-0.797-5.339-1.28-10.779-1.422-16.303h26.381v-6.921H35.875c0.142-5.524,0.625-10.963,1.422-16.302l9.702,1.711l1.201-6.816l-9.708-1.711c1.095-5.393,2.516-10.668,4.24-15.806l9.256,3.369l2.367-6.504l-9.254-3.368c2.016-5.1,4.336-10.046,6.939-14.817l8.509,4.911l3.459-5.994l-8.494-4.903c2.862-4.657,6.005-9.125,9.399-13.382l7.492,6.286l4.449-5.302l-7.486-6.282c3.615-4.084,7.477-7.946,11.562-11.562l6.286,7.489l5.301-4.449l-6.29-7.494c4.258-3.396,8.726-6.538,13.384-9.401l4.901,8.492l5.994-3.46l-4.909-8.506c4.771-2.603,9.718-4.924,14.818-6.939l3.369,9.255l6.504-2.367l-3.37-9.258c5.137-1.725,10.412-3.146,15.805-4.24l1.714,9.708l6.816-1.203l-1.713-9.702c5.339-0.796,10.777-1.28,16.301-1.421v9.846h6.922v-9.846c5.523,0.141,10.962,0.625,16.301,1.421l-1.713,9.702l6.816,1.203l1.714-9.708c5.393,1.094,10.667,2.515,15.804,4.239l-3.369,9.258l6.504,2.367l3.368-9.256c5.101,2.015,10.048,4.336,14.819,6.939l-4.909,8.508l5.994,3.459l4.9-8.493c4.658,2.863,9.126,6.005,13.384,9.401l-6.289,7.495l5.301,4.449l6.285-7.49c4.085,3.617,7.946,7.479,11.563,11.563l-7.486,6.283l4.449,5.302l7.492-6.287c3.395,4.257,6.536,8.724,9.398,13.381l-8.494,4.905l3.461,5.993l8.508-4.913c2.603,4.772,4.924,9.718,6.939,14.818l-9.255,3.37l2.367,6.503l9.258-3.371c1.725,5.138,3.146,10.413,4.24,15.807l-9.708,1.711l1.201,6.816l9.702-1.711c0.797,5.339,1.28,10.778,1.422,16.302H276.35v6.921h26.381C302.589,178.287,302.105,183.727,301.309,189.066z"/><path d="M189.766,191.022c4.402-1.555,7.948-7.063,9.68-14.091l-21.099,7.1C181.032,189.691,185.278,192.607,189.766,191.022z"/><path d="M215.203,182.132c4.328-1.53,7.828-6.876,9.592-13.73l-20.868,7.022C206.612,180.9,210.797,183.691,215.203,182.132z"/><path d="M148.846,191.022c4.482,1.585,8.732-1.331,11.414-6.992l-21.1-7.1C140.893,183.958,144.441,189.468,148.846,191.022z"/><path d="M123.4,182.132c4.415,1.559,8.594-1.232,11.281-6.709l-20.868-7.022C115.573,175.255,119.073,180.602,123.4,182.132z"/><path d="M215.471,193.755c-6.798,2.403-13.084-5.339-14.318-17.397l-0.145,0.049c0.6,12.244-4.198,23.842-10.974,26.239c-6.861,2.424-13.194-5.477-14.35-17.718l-6.379,2.146l-6.377-2.146c-1.156,12.241-7.492,20.141-14.348,17.717c-6.785-2.397-11.584-13.997-10.981-26.241l-0.146-0.049c-1.234,12.06-7.52,19.802-14.319,17.399c-6.713-2.375-11.483-13.792-10.984-25.914l-1.959-0.659v44.239l59.115,19.897l59.115-19.897v-44.239l-1.959,0.659C226.96,179.962,222.189,191.379,215.471,193.755z"/><path d="M110.15,128.777l0.039,0.013v23.872l59.115,19.897l59.115-19.897v-23.873l0.035-0.012l-59.15-21.49L110.15,128.777z M169.305,142.929l-42.667-14.35l42.667-15.501l42.664,15.501L169.305,142.929z"/><polygon points="201.225,110.545 169.303,52.664 137.381,110.436 169.303,91.635"/></g></svg> Qibla',
                    ] as $value => $label)
                    <label class="flex items-center gap-2 border border-gray-200 rounded-xl px-3 py-2.5 cursor-pointer hover:border-teal-400 hover:bg-teal-50 transition text-sm" style="display:flex;align-items:center;">
                        <input type="checkbox" name="pages[]" value="{{ $value }}"
                               {{ in_array($value, old('pages', [])) ? 'checked' : '' }}
                               class="accent-teal-600">
                        {!! $label !!}
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