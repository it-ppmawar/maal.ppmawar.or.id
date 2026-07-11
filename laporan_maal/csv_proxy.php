<?php
/**
 * csv_proxy.php — Proxy untuk Google Sheets CSV
 * Menghindari CORS/redirect issue saat fetch dari browser
 * Menggunakan caching 5 menit untuk performa optimal
 */

$CSV_URL = 'https://docs.google.com/spreadsheets/d/e/'
         . '2PACX-1vRYWArtmSJU9igeOkV-WvOk9x623BscfGYmXqc9a458gCXPGXMK4tQF7XRb-g5M_x9FQt_3Cg_hFdGz'
         . '/pub?gid=39941645&single=true&output=csv';

$CACHE_FILE = __DIR__ . '/csv_cache.txt';
$CACHE_TTL  = 300; // 5 menit

// ── CORS Headers ──────────────────────────────────────────────
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/csv; charset=utf-8');
header('Cache-Control: public, max-age=300');

// ── Cek cache ─────────────────────────────────────────────────
$forceFresh = isset($_GET['t']);
if (!$forceFresh && file_exists($CACHE_FILE) && (time() - filemtime($CACHE_FILE)) < $CACHE_TTL) {
    echo file_get_contents($CACHE_FILE);
    exit;
}

// ── Fetch dari Google Sheets ──────────────────────────────────
$csvData = false;

if (function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL            => $CSV_URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_MAXREDIRS      => 5,
        CURLOPT_TIMEOUT        => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible; CSVProxy/1.0)',
        CURLOPT_ENCODING       => '',
    ]);
    $csvData  = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200 || empty($csvData)) {
        $csvData = false;
    }
}

// Fallback: file_get_contents
if ($csvData === false) {
    $ctx = stream_context_create([
        'http' => [
            'method'          => 'GET',
            'follow_location' => 1,
            'max_redirects'   => 5,
            'timeout'         => 30,
            'user_agent'      => 'Mozilla/5.0 (compatible; CSVProxy/1.0)',
        ],
        'ssl' => [
            'verify_peer'      => false,
            'verify_peer_name' => false,
        ],
    ]);
    $csvData = @file_get_contents($CSV_URL, false, $ctx);
}

// ── Jika gagal, coba dari cache lama ─────────────────────────
if (empty($csvData)) {
    if (file_exists($CACHE_FILE)) {
        echo file_get_contents($CACHE_FILE);
        exit;
    }
    http_response_code(502);
    echo '# ERROR: Gagal mengambil data CSV dari Google Sheets';
    exit;
}

// ── Simpan ke cache & keluarkan ──────────────────────────────
file_put_contents($CACHE_FILE, $csvData);
echo $csvData;
