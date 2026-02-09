<?php

$outputPath = __DIR__ . '/storage/app/quran.json';
$allSurahs = [];

echo "Starting to fetch full Quran data for 114 Surahs...\n";

for ($i = 1; $i <= 114; $i++) {
    $url = "https://raw.githubusercontent.com/rioastamal/quran-json/master/surah/{$i}.json";
    echo "Fetching Surah {$i} from {$url}\n";

    $jsonContent = @file_get_contents($url);

    if ($jsonContent === false) {
        echo "Error fetching Surah {$i}. Skipping.\n";
        continue;
    }

    $data = json_decode($jsonContent, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Error decoding JSON for Surah {$i}: " . json_last_error_msg() . "\n";
        continue;
    }

    // Construct the verses array
    $verses = [];
    if (isset($data['text']) && isset($data['translations']['id']['text'])) {
        foreach ($data['text'] as $verseNumber => $arabicText) {
            $verses[] = [
                'number' => (int)$verseNumber,
                'arabic' => $arabicText,
                'translation' => $data['translations']['id']['text'][$verseNumber] ?? 'Terjemahan tidak tersedia.',
            ];
        }
    }

    // Transform Surah data to the new rich format
    $transformedSurah = [
        'number' => $data['number'],
        'name' => $data['name_latin'],
        'arabic_name' => $data['name'],
        'translation' => $data['translations']['id']['name'] ?? 'Arti tidak tersedia.',
        'total_verses' => $data['number_of_ayah'],
        'verses' => $verses,
    ];

    $allSurahs[] = $transformedSurah;
    echo "Processed Surah {$i}: {$transformedSurah['name']}\n";
}

echo "Finished fetching all Surahs. Writing to {$outputPath}...\n";

// Wrap the final array in the root 'surahs' object
$finalData = ['surahs' => $allSurahs];

// Write the combined data to the quran.json file
if (file_put_contents($outputPath, json_encode($finalData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo "Successfully wrote all Surahs with verse details to quran.json\n";
} else {
    echo "Error writing to quran.json\n";
}

echo "Script finished.\n";
?>
