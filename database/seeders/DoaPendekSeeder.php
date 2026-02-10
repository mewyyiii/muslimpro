<?php

namespace Database\Seeders;

use App\Models\DoaPendek;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DoaPendekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json = File::get(database_path('seeders/data/doapendek.json'));
        $doaPendek = json_decode($json);

        foreach ($doaPendek as $data) {
            DoaPendek::create([
                'id' => $data->id,
                'title' => $data->title,
                'arabic' => $data->arabic,
                'transliteration' => $data->transliteration,
                'translation' => $data->translation,
            ]);
        }
    }
}
