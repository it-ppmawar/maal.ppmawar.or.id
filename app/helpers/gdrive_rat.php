<?php
/**
 * gdrive_rat.php — Fetch & cache daftar file Laporan RAT dari Google Drive
 *
 * LANGKAH SETUP (sekali saja):
 * 1. Buka https://script.google.com/ → New Project
 * 2. Ganti semua kode dengan yang ada di artifact "Google Apps Script"
 * 3. Klik Deploy → New deployment → Web app
 *    - Execute as: Me
 *    - Who has access: Anyone
 * 4. Copy URL deployment → tempel ke $APPS_SCRIPT_URL di bawah ini
 * 5. Upload file ini ke cPanel
 */

define('GDRIVE_RAT_SCRIPT_URL', 'https://script.google.com/macros/s/AKfycbzE5eHFsTwkpjo4mbl0J6dUeXNCv466dKYfNoZOdorFE8I1nSnPtXAmySUFlDuDmAEgcg/exec');
define('GDRIVE_RAT_CACHE_FILE', __DIR__ . '/../../cache_rat.json');
define('GDRIVE_RAT_CACHE_TTL', 3600); // 1 jam

function getGDriveLaporanRAT()
{
    $cacheFile = GDRIVE_RAT_CACHE_FILE;
    $url       = GDRIVE_RAT_SCRIPT_URL;

    // Gunakan cache jika masih fresh (TTL belum habis)
    if (file_exists($cacheFile)) {
        $age = time() - filemtime($cacheFile);
        if ($age < GDRIVE_RAT_CACHE_TTL) {
            $cached = json_decode(file_get_contents($cacheFile), true);
            if (!empty($cached)) return $cached;
        }
    }

    // Jika URL belum diisi, kembalikan array kosong
    if ($url === 'PASTE_APPS_SCRIPT_URL_HERE' || empty($url)) {
        return [];
    }

    // Fetch dari Google Apps Script
    $data = null;
    if (function_exists('curl_init')) {
        $ch = curl_init($url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT        => 15,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT      => 'Mozilla/5.0',
        ]);
        $resp = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($resp && $code === 200) {
            $data = json_decode($resp, true);
        }
    } else {
        $ctx  = stream_context_create(['ssl' => ['verify_peer' => false]]);
        $resp = @file_get_contents($url, false, $ctx);
        if ($resp) $data = json_decode($resp, true);
    }

    // Simpan ke cache
    if (!empty($data)) {
        @file_put_contents($cacheFile, json_encode($data));
        return $data;
    }

    // Fallback ke cache lama jika fetch gagal
    if (file_exists($cacheFile)) {
        return json_decode(file_get_contents($cacheFile), true) ?: [];
    }

    return [];
}
