<?php

$outputPath = __DIR__ . '/storage/app/quran.json';
$allSurahs = [];

echo "Starting to fetch full Quran data for 114 Surahs (Robust Version)...";

function cleanTransliteration($text) {
    // Replace double vowels
    $text = str_replace(['AA', 'aa', 'ee', 'ii', 'oo', 'uu'], ['a', 'a', 'i', 'i', 'u', 'u'], $text);

    // Replace 'A' with apostrophe if it is preceded by a letter.
    $text = preg_replace('/(?<=[a-zA-Z])A/', "'", $text);

    return $text;
}

for ($i = 1; $i <= 114; $i++) {
    $url_ar = "https://alquran-api.pages.dev/api/quran/surah/{$i}";
    $url_id = "https://alquran-api.pages.dev/api/quran/surah/{$i}?lang=id";
    $url_tr = "https://alquran-api.pages.dev/api/quran/surah/{$i}?lang=transliteration";


    // Initialize cURL handles
    $ch_ar = curl_init($url_ar);
    $ch_id = curl_init($url_id);
    $ch_tr = curl_init($url_tr);

    // Set cURL options
    foreach ([$ch_ar, $ch_id, $ch_tr] as $ch) {
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');
    }

    // Create a multi-handle
    $mh = curl_multi_init();
    curl_multi_add_handle($mh, $ch_ar);
    curl_multi_add_handle($mh, $ch_id);
    curl_multi_add_handle($mh, $ch_tr);

    // Execute the multi-handle
    $running = null;
    do {
        curl_multi_exec($mh, $running);
    } while ($running);

    // Get the content
    $jsonContent_ar = curl_multi_getcontent($ch_ar);
    $jsonContent_id = curl_multi_getcontent($ch_id);
    $jsonContent_tr = curl_multi_getcontent($ch_tr);

    // Close the handles
    curl_multi_remove_handle($mh, $ch_ar);
    curl_multi_remove_handle($mh, $ch_id);
    curl_multi_remove_handle($mh, $ch_tr);
    curl_multi_close($mh);

    // Decode the JSON
    $data_ar = json_decode($jsonContent_ar, true);
    $data_id = json_decode($jsonContent_id, true);
    $data_tr = json_decode($jsonContent_tr, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("Error decoding JSON for Surah {$i}: " . json_last_error_msg() . ". Skipping.");
        continue;
    }

    // Construct the verses array
    $verses = [];
    if (isset($data_ar['verses']) && isset($data_id['verses']) && isset($data_tr['verses'])) {
        foreach ($data_ar['verses'] as $verseData) {
            $verse_id = $verseData['id'];
            $verse_ar = $verseData['text'];
        
            $verse_id_text = '';
            foreach($data_id['verses'] as $v) {
                if ($v['id'] == $verse_id) {
                    $verse_id_text = $v['translation'];
                    break;
                }
            }
        
            $verse_tr_text = '';
            foreach($data_tr['verses'] as $v) {
                if ($v['id'] == $verse_id) {
                    $verse_tr_text = cleanTransliteration($v['transliteration']);
                    break;
                }
            }
        
            $verses[] = [
                'number' => (int)$verse_id,
                'arabic' => $verse_ar,
                'translation' => $verse_id_text,
                'transliteration' => $verse_tr_text,
            ];
        }
    }

    // Transform Surah data to the new rich format
    $transformedSurah = [
        'number' => (int)($data_ar['id'] ?? 0),
        'name' => cleanTransliteration($data_ar['transliteration'] ?? 'Nama tidak tersedia'),
        'arabic_name' => $data_ar['name'] ?? 'الاسم غير متوفر',
        'translation' => $data_id['translation'] ?? 'Arti tidak tersedia.',
        'total_verses' => (int)($data_ar['total_verses'] ?? 0),
        'verses' => $verses,
    ];

    $allSurahs[] = $transformedSurah;
}

echo "Finished fetching all Surahs. Writing to {$outputPath}...";

// Wrap the final array in the root 'surahs' object
$finalData = ['surahs' => $allSurahs];

// Write the combined data to the quran.json file
if (file_put_contents($outputPath, json_encode($finalData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo "Successfully wrote all Surahs with verse details to quran.json";
} else {
    echo "Error writing to quran.json";
}

echo "Script finished.";
?>
