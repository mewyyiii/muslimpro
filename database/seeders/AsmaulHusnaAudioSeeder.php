<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsmaulHusnaAudioSeeder extends Seeder
{
    public function run(): void
    {
        $baseUrl = 'https://cdn.jsdelivr.net/gh/soachishti/Asma-ul-Husna@master/audio/';

        for ($i = 1; $i <= 99; $i++) {
            DB::table('asmaul_husna')
                ->where('id', $i)
                ->update([
                    'audio_url' => $baseUrl . $i . '.mp3',
                ]);
        }

        $this->command->info('✅ Audio URL untuk 99 Asmaul Husna berhasil diisi!');
    }
}