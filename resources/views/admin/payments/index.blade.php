@extends('layouts.admin')

@section('title', 'Pembayaran')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Manajemen Pembayaran</h1>
        <p class="text-sm text-gray-500 mt-1">Monitor semua transaksi upgrade Pro dari user</p>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

        <div class="bg-white rounded-2xl shadow p-5 flex items-center gap-4">
            <div class="bg-teal-100 text-teal-600 rounded-full p-3">
                <svg style="width:24px;height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500">Total Transaksi</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 flex items-center gap-4">
            <div class="bg-green-100 text-green-600 rounded-full p-3">
                <svg style="width:24px;height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500">Berhasil</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['success'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 flex items-center gap-4">
            <div class="bg-yellow-100 text-yellow-600 rounded-full p-3">
                <svg style="width:24px;height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500">Pending</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['pending'] }}</p>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow p-5 flex items-center gap-4">
            <div class="bg-emerald-100 text-emerald-700 rounded-full p-3">
                <svg style="width:24px;height:24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <p class="text-xs text-gray-500">Total Revenue</p>
                <p class="text-xl font-bold text-gray-800">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</p>
            </div>
        </div>

    </div>

    {{-- Filter --}}
    <div class="bg-white rounded-2xl shadow p-5">
        <form method="GET" action="{{ route('admin.payments.index') }}" class="flex flex-wrap gap-3 items-end">

            {{-- Search --}}
            <div class="flex-1 min-w-[180px]">
                <label class="block text-xs text-gray-500 mb-1">Cari User / Order ID</label>
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Nama, email, atau order ID..."
                    class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400"
                >
            </div>

            {{-- Filter Status --}}
            <div class="min-w-[140px]">
                <label class="block text-xs text-gray-500 mb-1">Status</label>
                <select name="status" class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400">
                    <option value="">Semua Status</option>
                    <option value="success"  {{ request('status') === 'success'  ? 'selected' : '' }}>Success</option>
                    <option value="pending"  {{ request('status') === 'pending'  ? 'selected' : '' }}>Pending</option>
                    <option value="failed"   {{ request('status') === 'failed'   ? 'selected' : '' }}>Failed</option>
                    <option value="expired"  {{ request('status') === 'expired'  ? 'selected' : '' }}>Expired</option>
                </select>
            </div>

            {{-- Filter Tanggal Dari --}}
            <div class="min-w-[140px]">
                <label class="block text-xs text-gray-500 mb-1">Dari Tanggal</label>
                <input
                    type="date"
                    name="date_from"
                    value="{{ request('date_from') }}"
                    class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400"
                >
            </div>

            {{-- Filter Tanggal Sampai --}}
            <div class="min-w-[140px]">
                <label class="block text-xs text-gray-500 mb-1">Sampai Tanggal</label>
                <input
                    type="date"
                    name="date_to"
                    value="{{ request('date_to') }}"
                    class="w-full border border-gray-200 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-teal-400"
                >
            </div>

            {{-- Tombol --}}
            <div class="flex gap-2">
                <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white text-sm px-4 py-2 rounded-xl transition">
                    <svg style="width:15px;height:15px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Filter
                </button>
                @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                    <a href="{{ route('admin.payments.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm px-4 py-2 rounded-xl transition">
                        ✕ Reset
                    </a>
                @endif
            </div>

        </form>
    </div>

    {{-- Tabel Transaksi --}}
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="font-semibold text-gray-700">Daftar Transaksi</h2>
            <span class="text-sm text-gray-400">{{ $transactions->total() }} transaksi ditemukan</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3 text-left">User</th>
                        <th class="px-6 py-3 text-left">Order ID</th>
                        <th class="px-6 py-3 text-left">Nominal</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Dibayar</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse ($transactions as $trx)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- User --}}
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-800">{{ $trx->user->name ?? '-' }}</div>
                            <div class="text-xs text-gray-400">{{ $trx->user->email ?? '' }}</div>
                        </td>

                        {{-- Order ID --}}
                        <td class="px-6 py-4 text-gray-500 font-mono text-xs">
                            {{ $trx->order_id }}
                        </td>

                        {{-- Nominal --}}
                        <td class="px-6 py-4 font-semibold text-gray-700">
                            Rp {{ number_format($trx->amount, 0, ',', '.') }}
                        </td>

                        {{-- Status Badge --}}
                        <td class="px-6 py-4">
                            @php
                                $badge = match($trx->status) {
                                    'success' => 'bg-green-100 text-green-700',
                                    'pending' => 'bg-yellow-100 text-yellow-700',
                                    'failed'  => 'bg-red-100 text-red-700',
                                    'expired' => 'bg-gray-100 text-gray-500',
                                    default   => 'bg-gray-100 text-gray-500',
                                };
                                $icon = match($trx->status) {
                                    'success' => '<svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
                                    'pending' => '<svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                                    'failed'  => '<svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
                                    'expired' => '<svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                                    default   => '<svg style="width:12px;height:12px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
                                };
                            @endphp
                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-medium {{ $badge }}">
                                {!! $icon !!} {{ ucfirst($trx->status) }}
                            </span>
                        </td>

                        {{-- Tanggal Dibuat --}}
                        <td class="px-6 py-4 text-gray-500 text-xs">
                            {{ $trx->created_at->format('d M Y') }}<br>
                            <span class="text-gray-400">{{ $trx->created_at->format('H:i') }}</span>
                        </td>

                        {{-- Paid At --}}
                        <td class="px-6 py-4 text-gray-500 text-xs">
                            @if($trx->paid_at)
                                {{ $trx->paid_at->format('d M Y') }}<br>
                                <span class="text-gray-400">{{ $trx->paid_at->format('H:i') }}</span>
                            @else
                                <span class="text-gray-300">—</span>
                            @endif
                        </td>

                        {{-- Aksi --}}
                        <td class="px-6 py-4">
                            <button
                                onclick="openModal({{ $trx->id }})"
                                class="text-teal-600 hover:text-teal-800 text-xs font-medium transition" style="display:inline-flex;align-items:center;gap:4px;"
                            >
                                <svg style="width:14px;height:14px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                </svg>
                                Detail
                            </button>
                        </td>

                    </tr>

                    {{-- Hidden Modal Data --}}
                    <template id="modal-data-{{ $trx->id }}">
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500">Nama User</span>
                                <span class="font-medium text-gray-800">{{ $trx->user->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500">Email</span>
                                <span class="font-medium text-gray-800">{{ $trx->user->email ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500">Role Saat Ini</span>
                                <span class="font-medium text-gray-800">{{ $trx->user->role->name ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500">Order ID</span>
                                <span class="font-mono text-xs text-gray-600">{{ $trx->order_id }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500">Nominal</span>
                                <span class="font-bold text-gray-800">Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500">Status</span>
                                <span class="font-medium text-gray-800">{{ ucfirst($trx->status) }}</span>
                            </div>
                            <div class="flex justify-between py-2 border-b border-gray-100">
                                <span class="text-gray-500">Dibuat</span>
                                <span class="text-gray-600">{{ $trx->created_at->format('d M Y, H:i') }}</span>
                            </div>
                            <div class="flex justify-between py-2">
                                <span class="text-gray-500">Dibayar</span>
                                <span class="text-gray-600">{{ $trx->paid_at ? $trx->paid_at->format('d M Y, H:i') : '—' }}</span>
                            </div>
                        </div>
                    </template>

                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <div style="display:flex;justify-content:center;margin-bottom:10px;color:#d1d5db;">
                                <svg style="width:48px;height:48px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <p>Belum ada transaksi ditemukan.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $transactions->withQueryString()->links() }}
        </div>
        @endif
    </div>

</div>

{{-- Modal Detail --}}
<div id="detail-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md mx-4 overflow-hidden">
        <div class="flex justify-between items-center px-6 py-4 border-b border-gray-100">
            <h3 class="font-semibold text-gray-800">Detail Transaksi</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600 text-xl leading-none">&times;</button>
        </div>
        <div id="modal-content" class="px-6 py-4"></div>
        <div class="px-6 py-4 border-t border-gray-100 text-right">
            <button onclick="closeModal()" class="bg-gray-100 hover:bg-gray-200 text-gray-600 text-sm px-4 py-2 rounded-xl transition">
                Tutup
            </button>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('detail-modal');
    const modalContent = document.getElementById('modal-content');

    function openModal(id) {
        const template = document.getElementById('modal-data-' + id);
        if (template) {
            modalContent.innerHTML = template.innerHTML;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }
    }

    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Tutup modal klik backdrop
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });
</script>
@endsection