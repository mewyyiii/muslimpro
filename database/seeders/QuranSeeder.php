<?php

namespace Database\Seeders;

use App\Models\Surah;
use App\Models\Verse;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class QuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('verses')->truncate();
        DB::table('surahs')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $json = File::get(database_path('seeders/data/quran.json'));
        $data = json_decode($json);

        foreach ($data->surahs as $surahData) {
            $audioUrl = "https://cdn.islamic.network/quran/audio-surah/128/ar.alafasy/{$surahData->number}.mp3";

            $surah = Surah::create([
                'number' => $surahData->number,
                'name' => $surahData->name,
                'arabic_name' => $surahData->arabic_name,
                'translation' => $surahData->translation,
                'total_verses' => $surahData->total_verses,
                'audio_url' => $audioUrl,
            ]);

            foreach ($surahData->verses as $verseData) {
                Verse::create([
                    'surah_number' => $surah->number,
                    'number' => $verseData->number,
                    'arabic' => $verseData->arabic,
                    'translation' => $verseData->translation,
                    'transliteration' => $verseData->transliteration,
                ]);
            }
        }
    }
}
