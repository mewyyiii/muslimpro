@extends('layouts.admin')

@section('title', 'Manage Iklan')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-700">Manage Iklan</h2>
        <a href="{{ route('admin.ads.create') }}"
           class="bg-teal-600 hover:bg-teal-700 text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition">
            + Tambah Iklan
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="bg-teal-50 border border-teal-200 text-teal-700 px-5 py-3 rounded-xl mb-6 text-sm" style="display:flex;align-items:center;gap:8px;">
            <svg style="width:18px;height:18px;flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    {{-- Table --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-500 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4 text-left">Iklan</th>
                    <th class="px-6 py-4 text-left">Posisi</th>
                    <th class="px-6 py-4 text-left">Halaman</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($ads as $ad)
                <tr class="hover:bg-gray-50 transition">

                    {{-- Iklan --}}
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img src="{{ $ad->image_url }}"
                                 class="w-16 h-10 object-cover rounded-lg border border-gray-200">
                            <div>
                                <p class="font-medium text-gray-700">{{ $ad->title }}</p>
                                @if($ad->url)
                                    <p class="text-xs text-gray-400 truncate max-w-[180px]">{{ $ad->url }}</p>
                                @endif
                            </div>
                        </div>
                    </td>

                    {{-- Posisi --}}
                    <td class="px-6 py-4">
                        <span class="bg-blue-50 text-blue-600 text-xs font-medium px-3 py-1 rounded-full">
                            {{ $ad->position === 'in_content' ? 'In Content' : 'Footer Sticky' }}
                        </span>
                    </td>

                    {{-- Halaman --}}
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($ad->pages as $page)
                                <span class="bg-gray-100 text-gray-600 text-xs px-2 py-0.5 rounded-full">
                                    {{ $page }}
                                </span>
                            @endforeach
                        </div>
                    </td>

                    {{-- Status --}}
                    <td class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.ads.toggle', $ad) }}">
                            @csrf
                            <button type="submit"
                                style="display:inline-flex;align-items:center;gap:4px;" class="text-xs font-semibold px-3 py-1 rounded-full transition
                                       {{ $ad->is_active
                                           ? 'bg-teal-100 text-teal-700 hover:bg-teal-200'
                                           : 'bg-red-100 text-red-600 hover:bg-red-200' }}">
                                {!! $ad->is_active
    ? '<svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Aktif'
    : '<svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/></svg> Nonaktif'
!!}
                            </button>
                        </form>
                    </td>

                    {{-- Aksi --}}
                    <td class="px-6 py-4">
                        <form method="POST" action="{{ route('admin.ads.destroy', $ad) }}"
                              onsubmit="return confirm('Hapus iklan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="text-xs text-red-500 hover:text-red-700 font-medium transition" style="display:inline-flex;align-items:center;gap:4px;background:none;border:none;cursor:pointer;padding:0;">
                                <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                        Belum ada iklan. <a href="{{ route('admin.ads.create') }}" class="text-teal-600 font-medium">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection