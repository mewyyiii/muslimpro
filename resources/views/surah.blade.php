@extends('layouts.app')

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&display=swap');
    
    .font-arabic {
        font-family: 'Amiri', serif;
    }
    
    /* Container dengan padding untuk back button */
    .page-container {
        max-width: 7xl;
        margin: 0 auto;
        padding: 0 1rem;
    }
    
    /* Back Button - Simple & Clean di pojok kiri atas */
    .back-nav {
        padding: 1.5rem 0 1rem 0;
    }
    
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 0;
        color: var(--text-primary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.2s ease;
        font-size: 0.95rem;
    }
    
    .back-button:hover {
        color: var(--primary-accent);
        transform: translateX(-4px);
    }
    
    .back-button svg {
        width: 18px;
        height: 18px;
    }
    
    /* Surah Header - Lebih compact */
    .surah-header {
        background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
        padding: 2.5rem 1.5rem;
        margin-bottom: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        text-align: center;
        color: white;
    }
    
    .surah-arabic {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .surah-latin {
        font-size: 1.75rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
        opacity: 0.95;
    }
    
    .surah-info {
        font-size: 1rem;
        opacity: 0.9;
        margin-top: 0.5rem;
    }
    
    /* Audio Player Section */
    .audio-player-section {
        background-color: var(--surface);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }
    
    .audio-player-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .play-all-btn {
        padding: 0.65rem 1.25rem;
        background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
        color: white;
        border: none;
        border-radius: 0.5rem;
        cursor: pointer;
        font-weight: 500;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .play-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    
    /* Verse Card */
    .verse-card {
        background-color: var(--surface);
        border-radius: 1rem;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .verse-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    }
    
    .verse-card.playing {
        border-color: var(--primary-accent);
        box-shadow: 0 4px 20px rgba(59, 130, 246, 0.2);
    }
    
    .verse-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--primary-accent);
    }
    
    .verse-number {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    
    .verse-number-badge {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary-accent), var(--secondary-accent));
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1rem;
    }
    
    .play-verse-btn {
        background-color: var(--primary-accent);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    
    .play-verse-btn:hover {
        background-color: var(--secondary-accent);
        transform: scale(1.1);
    }
    
    .play-verse-btn.playing {
        background-color: #10b981;
    }
    
    .verse-arabic-text {
        font-size: 2rem;
        line-height: 2.5rem;
        text-align: right;
        margin-bottom: 1.5rem;
        color: var(--text-primary);
        direction: rtl;
    }
    
    .verse-translation {
        background-color: rgba(59, 130, 246, 0.05);
        padding: 1rem;
        border-radius: 0.75rem;
        border-left: 4px solid var(--primary-accent);
        margin-bottom: 1rem;
    }
    
    .verse-translation p {
        color: var(--text-primary);
        line-height: 1.75;
        margin: 0;
        font-size: 1rem;
    }
    
    .verse-latin {
        font-style: italic;
        color: var(--text-primary-muted);
        font-size: 0.95rem;
        line-height: 1.6;
    }
    
    /* Bismillah Badge (opsional untuk ayat 1 pada setiap surah kecuali At-Taubah) */
    .bismillah-badge {
        text-align: center;
        padding: 1rem;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(16, 185, 129, 0.1));
        border-radius: 1rem;
        margin-bottom: 2rem;
        border: 2px solid var(--primary-accent);
    }
    
    .bismillah-badge .arabic {
        font-size: 2rem;
        color: var(--text-primary);
        font-weight: 700;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .surah-arabic {
            font-size: 2.5rem;
        }
        
        .surah-latin {
            font-size: 1.25rem;
        }
        
        .verse-arabic-text {
            font-size: 1.5rem;
            line-height: 2rem;
        }
        
        .back-button {
            font-size: 0.875rem;
        }
        
        .audio-player-header {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>
@endpush

@section('content')
<div class="page-container max-w-7xl mx-auto">
    <!-- Back Navigation - Simple di pojok kiri atas -->
    <div class="back-nav">
        <a href="{{ route('quran.index') }}" class="back-button">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/>
            </svg>
            <span>Kembali ke Daftar Surah</span>
        </a>
    </div>
    
    <!-- Surah Header -->
    <div class="surah-header">
        <h1 class="surah-arabic font-arabic">{{ $surah['arabic_name'] }}</h1>
        <h2 class="surah-latin">{{ $surah['name'] }}</h2>
        <p class="surah-info">{{ $surah['translation'] }} • {{ $surah['total_verses'] }} Ayat</p>
    </div>
    
    <!-- Audio Player Section -->
    <div class="audio-player-section">
        <div class="audio-player-header">
            <div>
                <h3 style="color: var(--text-primary); font-weight: 600; margin: 0;">Audio Surah</h3>
                <p style="color: var(--text-primary-muted); font-size: 0.875rem; margin: 0.25rem 0 0 0;">
                    Klik tombol play pada ayat untuk mendengarkan
                </p>
            </div>
            <button class="play-all-btn" onclick="playAllVerses()">
                <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 5v14l11-7z"/>
                </svg>
                <span>Putar Semua</span>
            </button>
        </div>
        
        <audio id="main-audio-player" controls style="width: 100%; border-radius: 0.5rem;">
            <source src="" type="audio/mpeg">
            Browser Anda tidak mendukung audio player.
        </audio>
    </div>
    
    <!-- Bismillah (Opsional - tampilkan jika bukan At-Taubah) -->
    @if($surah['number'] != 9)
        <div class="bismillah-badge font-arabic">
            <div class="arabic">بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ</div>
            <div style="color: var(--text-primary-muted); font-size: 0.875rem; margin-top: 0.5rem;">
                Dengan nama Allah Yang Maha Pengasih, Maha Penyayang
            </div>
        </div>
    @endif
    
    <!-- Verses List -->
    <div id="verses-container">
        @foreach($verses as $verse)
            <div class="verse-card" id="verse-{{ $verse['number'] }}" data-audio="{{ $verse['audio'] }}">
                <!-- Verse Header -->
                <div class="verse-header">
                    <div class="verse-number">
                        <div class="verse-number-badge">{{ $verse['number'] }}</div>
                        <span style="color: var(--text-primary); font-weight: 600;">Ayat {{ $verse['number'] }}</span>
                    </div>
                    <button class="play-verse-btn" onclick="playVerse('{{ $verse['audio'] }}', {{ $verse['number'] }})" title="Putar ayat ini" id="play-btn-{{ $verse['number'] }}">
                        <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M8 5v14l11-7z"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Arabic Text -->
                <div class="verse-arabic-text font-arabic">
                    {{ $verse['arabic'] }}
                </div>
                
                <!-- Translation -->
                <div class="verse-translation">
                    <p><strong>Terjemahan:</strong> {{ $verse['translation'] }}</p>
                </div>
                
                <!-- Latin Text (Transliteration) -->
                @if(isset($verse['latin']))
                    <div class="verse-latin">
                        <strong>Latin:</strong> {{ $verse['latin'] }}
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    const audioPlayer = document.getElementById('main-audio-player');
    let currentVerseNumber = null;
    let isPlayingAll = false;
    let allVerses = @json($verses);
    let currentPlayIndex = 0;
    
    // Function to play a specific verse
    function playVerse(audioUrl, verseNumber) {
        audioPlayer.src = audioUrl;
        audioPlayer.play();
        
        // Update current verse
        updateCurrentVerse(verseNumber);
        
        // Scroll to verse
        const verseElement = document.getElementById('verse-' + verseNumber);
        if (verseElement) {
            verseElement.scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center' 
            });
        }
    }
    
    // Function to update current verse visual state
    function updateCurrentVerse(verseNumber) {
        // Remove previous highlights
        document.querySelectorAll('.verse-card').forEach(card => {
            card.classList.remove('playing');
        });
        
        document.querySelectorAll('.play-verse-btn').forEach(btn => {
            btn.classList.remove('playing');
        });
        
        // Highlight current verse
        const currentCard = document.getElementById('verse-' + verseNumber);
        const currentBtn = document.getElementById('play-btn-' + verseNumber);
        
        if (currentCard) {
            currentCard.classList.add('playing');
        }
        
        if (currentBtn) {
            currentBtn.classList.add('playing');
        }
        
        currentVerseNumber = verseNumber;
    }
    
    // Function to play all verses sequentially
    function playAllVerses() {
        isPlayingAll = true;
        currentPlayIndex = 0;
        playNextVerse();
    }
    
    function playNextVerse() {
        if (currentPlayIndex < allVerses.length && isPlayingAll) {
            const verse = allVerses[currentPlayIndex];
            playVerse(verse.audio, verse.number);
            currentPlayIndex++;
        } else {
            isPlayingAll = false;
            currentPlayIndex = 0;
        }
    }
    
    // Auto-play next verse when current ends (if playing all)
    audioPlayer.addEventListener('ended', function() {
        if (isPlayingAll) {
            // Small delay before playing next verse
            setTimeout(playNextVerse, 500);
        } else {
            // Remove playing state when single verse ends
            document.querySelectorAll('.verse-card').forEach(card => {
                card.classList.remove('playing');
            });
            document.querySelectorAll('.play-verse-btn').forEach(btn => {
                btn.classList.remove('playing');
            });
        }
    });
    
    // Handle manual audio control (pause/play)
    audioPlayer.addEventListener('pause', function() {
        if (!audioPlayer.ended) {
            isPlayingAll = false;
        }
    });
</script>
@endpush
