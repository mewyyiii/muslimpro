@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@700&display=swap');

    .font-arabic {
        font-family: 'Amiri', serif;
    }

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

    /* Saat diklik → putih */
    .asma-card.active {
        background: var(--surface, #ffffff);
        color: var(--text-primary, #1f2937);
        border: 2px solid #10B981;
    }

    .asma-card.active h2,
    .asma-card.active h3,
    .asma-card.active p {
        color: var(--text-primary, #1f2937) !important;
    }

    .asma-card.active .asma-muted {
        color: #6b7280 !important;
    }

    .asma-number {
        background-color: rgba(255, 255, 255, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 9999px;
        flex-shrink: 0;
    }

    .asma-card.active .asma-number {
        background-color: #10B981;
    }

    .asma-muted {
        color: rgba(255, 255, 255, 0.85);
    }
</style>
@endpush

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-8">

    <h1 class="text-3xl font-bold text-center mb-6 mt-4">
        Asmaul Husna
    </h1>

    <div id="asmaul-husna-grid"
         class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($asmaulHusna as $name)
            <div class="asmaul-husna-card asma-card block p-5 shadow-md"
                 data-search-terms="{{ strtolower($name->transliteration . ' ' . $name->meaning_id) }}">

                <div class="flex justify-between items-center mb-3">

                    <div class="asma-number">
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
                </div>

            </div>
        @endforeach

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const cards = document.querySelectorAll('.asma-card');

    cards.forEach(card => {
        card.addEventListener('click', function () {
            card.classList.toggle('active');
        });
    });
});
</script>
@endpush