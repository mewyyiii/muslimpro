@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');

    .font-arabic {
        font-family: 'Amiri', serif;
    }

    /* ===== Tampilan Awal Emerald ===== */
    .asma-card {
        background: linear-gradient(90deg, #1FAF90, #10B981);
        color: white;
        border-radius: 14px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .asma-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.2);
    }

    /* ===== Saat Diklik (kembali ke warna lama) ===== */
    .asma-card.active {
        background: var(--surface);
        color: var(--text-primary);
    }

    .asma-card.active h2,
    .asma-card.active h3,
    .asma-card.active p {
        color: var(--text-primary) !important;
    }

    /* Lingkaran Nomor */
    .asma-number {
        background-color: rgba(255,255,255,0.25);
    }

    .asma-card.active .asma-number {
        background-color: var(--primary-accent);
    }

    /* Teks putih soft */
    .asma-muted {
        color: rgba(255,255,255,0.85);
    }

    .asma-card.active .asma-muted {
        color: var(--text-primary-muted);
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">

    <h1 class="text-3xl font-bold text-center mb-6 mt-4">
        Asmaul Husna
    </h1>
    
    <div class="w-full max-w-md mx-auto mb-8">
        <div class="relative">
            <input type="text"
                id="asmaul-search-input"
                placeholder="Cari Asmaul Husna..."
                class="w-full pl-16 pr-4 py-3 rounded-xl border-2 focus:outline-none focus:ring-2 transition-all"
                style="
                    background-color: var(--surface);
                    color: var(--text-primary);
                    border-color: #10B981;
                ">

            <!-- Icon Search -->
            <div class="absolute left-5 top-1/2 transform -translate-y-1/2"
                style="color: #047857;">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-5 h-5"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M21 21l-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div>

    <div id="asmaul-husna-grid"
         class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($asmaulHusna as $name)
            <div class="asmaul-husna-card asma-card block p-5 shadow-md"
                 data-search-terms="{{ strtolower($name->transliteration . ' ' . $name->meaning_id) }}">

                <div class="flex justify-between items-center mb-3">

                    <div class="flex items-center justify-center w-10 h-10 rounded-full asma-number">
                        <span class="font-bold text-sm text-white">
                            {{ $name->id }}
                        </span>
                    </div>

                    <div class="text-right">
                        <h3 class="text-2xl font-arabic font-bold text-white">
                            {{ $name->arabic }}
                        </h3>
                    </div>

                </div>

                <div>
                    <h2 class="text-lg font-bold text-white">
                        {{ $name->transliteration }}
                    </h2>

                    <p class="text-sm asma-muted">
                        {{ $name->meaning_id }}
                    </p>

                    <p class="text-xs mt-2 asma-muted">
                        {{ $name->meaning_en }}
                    </p>
                </div>

            </div>
        @endforeach

    </div>
</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    /* === Klik untuk ubah warna === */
    const cards = document.querySelectorAll('.asma-card');

    cards.forEach(card => {
        card.addEventListener('click', function () {
            card.classList.toggle('active');
        });
    });

    /* === Search Function === */
    const searchInput = document.getElementById('asmaul-husna-search-input');
    const asmaulHusnaGrid = document.getElementById('asmaul-husna-grid');
    const asmaulHusnaCards = asmaulHusnaGrid.getElementsByClassName('asmaul-husna-card');

    searchInput.addEventListener('keyup', function () {
        const searchTerm = searchInput.value.toLowerCase().trim();

        for (let i = 0; i < asmaulHusnaCards.length; i++) {
            const card = asmaulHusnaCards[i];
            const searchTerms = card.getAttribute('data-search-terms');
            
            if (searchTerms.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        }
    });

});
</script>
@endpush
