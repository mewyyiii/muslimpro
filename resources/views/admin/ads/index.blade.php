@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 px-4">
    <div class="max-w-6xl mx-auto">

        {{-- ══ HEADER ══ --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">📢 Kelola Iklan</h1>
                <p class="text-sm text-gray-500 mt-0.5">Kelola banner iklan yang tampil untuk pengguna gratis</p>
            </div>
            <a href="{{ route('admin.ads.create') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-teal-500 hover:bg-teal-600
                      text-white font-bold text-sm rounded-xl shadow transition-colors">
                + Buat Iklan Baru
            </a>
        </div>

        {{-- ══ STATS ══ --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
            <div class="bg-white rounded-2xl p-4 shadow-sm text-center">
                <p class="text-2xl font-extrabold text-gray-800">{{ $stats['total'] }}</p>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Total Iklan</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm text-center">
                <p class="text-2xl font-extrabold text-teal-600">{{ $stats['active'] }}</p>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Sedang Aktif</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm text-center">
                <p class="text-2xl font-extrabold text-indigo-600">{{ number_format($stats['total_impr']) }}</p>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Total Impresi</p>
            </div>
            <div class="bg-white rounded-2xl p-4 shadow-sm text-center">
                <p class="text-2xl font-extrabold text-amber-500">{{ number_format($stats['total_clicks']) }}</p>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Total Klik</p>
            </div>
        </div>

        {{-- ══ SUCCESS/ERROR FLASH ══ --}}
        @if(session('success'))
        <div class="mb-4 p-3 bg-teal-50 border border-teal-200 text-teal-700 text-sm font-medium rounded-xl">
            ✓ {{ session('success') }}
        </div>
        @endif

        {{-- ══ TABLE ══ --}}
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            @if($ads->isEmpty())
                <div class="text-center py-16 text-gray-400">
                    <p class="text-4xl mb-3">📭</p>
                    <p class="font-semibold">Belum ada iklan</p>
                    <p class="text-sm mt-1">Buat iklan pertama untuk mulai monetisasi</p>
                </div>
            @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Iklan</th>
                            <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Posisi</th>
                            <th class="text-left px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Halaman</th>
                            <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Impresi</th>
                            <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Klik</th>
                            <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="text-center px-4 py-3 text-xs font-bold text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($ads as $ad)
                        <tr class="hover:bg-gray-50 transition-colors">
                            {{-- Iklan info --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    @if($ad->image_path)
                                        <img src="{{ $ad->image_url }}" class="w-12 h-10 object-cover rounded-lg flex-shrink-0">
                                    @else
                                        <div class="w-12 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0 text-xl">📢</div>
                                    @endif
                                    <div>
                                        <p class="font-semibold text-gray-800">{{ $ad->title }}</p>
                                        @if($ad->url)
                                            <p class="text-xs text-gray-400 truncate max-w-[180px]">{{ $ad->url }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Posisi --}}
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 rounded-lg text-xs font-semibold
                                    {{ $ad->position === 'footer_sticky' ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                                    {{ $ad->position === 'footer_sticky' ? '📌 Footer' : '📄 In-Content' }}
                                </span>
                            </td>

                            {{-- Halaman --}}
                            <td class="px-4 py-3 text-xs text-gray-500">
                                {{ $ad->pages ? implode(', ', $ad->pages) : 'Semua halaman' }}
                            </td>

                            {{-- Impresi --}}
                            <td class="px-4 py-3 text-center font-semibold text-gray-600">
                                {{ number_format($ad->impression_count) }}
                            </td>

                            {{-- Klik --}}
                            <td class="px-4 py-3 text-center">
                                <span class="font-semibold text-amber-600">{{ number_format($ad->click_count) }}</span>
                                @if($ad->impression_count > 0)
                                    <span class="text-xs text-gray-400 block">
                                        CTR: {{ round(($ad->click_count / $ad->impression_count) * 100, 1) }}%
                                    </span>
                                @endif
                            </td>

                            {{-- Status toggle --}}
                            <td class="px-4 py-3 text-center">
                                <button onclick="toggleAd({{ $ad->id }}, this)"
                                        data-active="{{ $ad->is_active ? '1' : '0' }}"
                                        class="px-2.5 py-1 rounded-full text-xs font-bold transition-all
                                               {{ $ad->is_active ? 'bg-teal-100 text-teal-700 hover:bg-teal-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                    {{ $ad->status_label }}
                                </button>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.ads.edit', $ad) }}"
                                       class="px-3 py-1.5 bg-indigo-50 text-indigo-600 hover:bg-indigo-100 text-xs font-semibold rounded-lg transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.ads.destroy', $ad) }}" method="POST"
                                          onsubmit="return confirm('Hapus iklan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="px-3 py-1.5 bg-red-50 text-red-500 hover:bg-red-100 text-xs font-semibold rounded-lg transition-colors">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($ads->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                {{ $ads->links() }}
            </div>
            @endif
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleAd(adId, btn) {
    fetch(`/admin/ads/${adId}/toggle`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            btn.textContent = data.label;
            btn.dataset.active = data.is_active ? '1' : '0';
            btn.className = btn.className.replace(
                /bg-(teal|gray)-100 text-(teal|gray)-\w+/g, ''
            );
            if (data.is_active) {
                btn.classList.add('bg-teal-100', 'text-teal-700', 'hover:bg-teal-200');
                btn.classList.remove('bg-gray-100', 'text-gray-500', 'hover:bg-gray-200');
            } else {
                btn.classList.add('bg-gray-100', 'text-gray-500', 'hover:bg-gray-200');
                btn.classList.remove('bg-teal-100', 'text-teal-700', 'hover:bg-teal-200');
            }
        }
    });
}
</script>
@endpush