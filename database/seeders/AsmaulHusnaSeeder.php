<?php

namespace Database\Seeders;

use App\Models\AsmaulHusna;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class AsmaulHusnaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/data/asmaul_husna.json')); // Assuming data will be moved to database/seeders/data
        $asmaulHusna = json_decode($json);

        foreach ($asmaulHusna as $data) {
            AsmaulHusna::create([
                'id' => $data->id,
                'arabic' => $data->arabic,
                'transliteration' => $data->transliteration,
                'meaning_id' => $data->meaning_id,
                'meaning_en' => $data->meaning_en,
            ]);
        }
    }
}
