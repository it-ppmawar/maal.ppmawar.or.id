<?php
/**
 * csv_proxy.php — Proxy untuk Google Sheets CSV
 * Menghindari CORS/redirect issue saat fetch dari browser
 *
 * Mode 1: Default (tanpa parameter) — gabungkan 2 sumber CSV utama
 * Mode 2: ?sheet=GID — ambil sheet detail donatur berdasarkan gid
 */

// ── CORS Headers ──────────────────────────────────────────────
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/csv; charset=utf-8');
header('Cache-Control: public, max-age=300');

// ── Fetch dari Google Sheets ──────────────────────────────────
function fetchCsvData($url) {
    $data = false;
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 5,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT      => 'Mozilla/5.0 (compatible; CSVProxy/1.0)',
            CURLOPT_ENCODING       => '',
        ]);
        $data     = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($httpCode !== 200 || empty($data)) $data = false;
    }
    // Fallback: file_get_contents
    if ($data === false) {
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
        $data = @file_get_contents($url, false, $ctx);
    }
    return $data;
}

// ── Dynamic GID Mapping & Authorization ───────────────────────
function getDynamicGidMapping() {
    $pubhtmlUrl = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vSIHXx0HPCr1L-tIzO4TqzwdtzWlFq2ZCO7aTVgyFX0jM3fvqnF8oJlXCdzaCotsfG6O_ze6MZlfy7J/pubhtml';
    $cacheFile = __DIR__ . '/csv_cache_gids_map.json';
    $cacheTTL  = 300; // 5 menit

    $forceFresh = isset($_GET['t']);
    if (!$forceFresh && file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTTL) {
        $map = json_decode(file_get_contents($cacheFile), true);
        if (is_array($map) && !empty($map)) {
            return $map;
        }
    }

    $html = fetchCsvData($pubhtmlUrl);
    if (empty($html)) {
        if (file_exists($cacheFile)) {
            return json_decode(file_get_contents($cacheFile), true);
        }
        return [];
    }

    // Ekstrak items.push({name: "Name", gid: "xxxx", ...})
    $matches = [];
    preg_match_all('/items\.push\(\{name:\s*"([^"]+)",[^}]*gid:\s*"([^"]+)"/', $html, $matches);

    $map = [];
    if (!empty($matches[1]) && !empty($matches[2])) {
        for ($i = 0; $i < count($matches[1]); $i++) {
            $rawName = trim($matches[1][$i]);
            $gid     = trim($matches[2][$i]);
            
            // 1. Cek jika nama diawali angka dan underscore, misal "40_MASJID..."
            if (preg_match('/^([0-9]+)_/', $rawName, $numMatch)) {
                $rowNo = (int)$numMatch[1];
                $map[(string)$rowNo] = $gid;
            }
            
            // 2. Simpan mapping nama lembaga (clean name & uppercase)
            $cleanName = preg_replace('/^[0-9]+_/', '', $rawName);
            $cleanName = str_replace('_', ' ', $cleanName);
            $cleanName = strtoupper(trim($cleanName));
            
            if ($cleanName !== '') {
                $map[$cleanName] = $gid;
                if (strpos($cleanName, 'WAKAF ') === 0) {
                    $withoutWakaf = trim(substr($cleanName, 6));
                    $map[$withoutWakaf] = $gid;
                } else {
                    $map['WAKAF ' . $cleanName] = $gid;
                }
            }
        }
    }

    if (!empty($map)) {
        file_put_contents($cacheFile, json_encode($map));
    }
    return $map;
}

// ── Mode 3: API Endpoint untuk mengambil dynamic GID map ─────
if (isset($_GET['action']) && $_GET['action'] === 'gids') {
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: public, max-age=300');
    $map = getDynamicGidMapping();
    echo json_encode($map);
    exit;
}

// ── Mode 2: Fetch sheet detail donatur berdasarkan GID ────────
if (isset($_GET['sheet'])) {
    $gid = preg_replace('/[^0-9]/', '', $_GET['sheet']); // sanitize: hanya angka
    if ($gid === '') {
        // Catatan: empty('0')=true di PHP, jadi pakai === bukan empty()
        http_response_code(400);
        header('Content-Type: text/csv; charset=utf-8');
        echo '# ERROR: GID tidak valid';
        exit;
    }

    // Dynamic whitelist
    $dynamicMap = getDynamicGidMapping();
    $allowedGids = array_values($dynamicMap);

    // Fallback static whitelist
    $fallbackGids = [
        '0',
        '815882114','692127026','1033221722','2041381285','880015158',
        '46867664','1353982802','1645598484','1039694087','191573258',
        '266769621','2105138912','154288844','1089541906','1817395424',
        '1461444370','417334554','1605777175','1860197928','1017191582',
        '1045001837','849697066','608032516','1480201920','1537156219',
        '154071510','1763681551','1578797073','7345578','1578635629',
        '1748260230','1334635358','493324393','10164437','85518130',
        '2062048297','333525895','1961650162','1353132146','1413048939',
        '781470666','1886865352','1460701178','1411634932','1950779001',
        '2111356193','2059491987','1646400826','39426388','782360893',
        '1769728255','1189786236','1188232546',
    ];

    $allAllowedGids = array_unique(array_merge($allowedGids, $fallbackGids));

    if (!in_array($gid, $allAllowedGids)) {
        http_response_code(403);
        header('Content-Type: text/csv; charset=utf-8');
        echo '# ERROR: GID tidak diizinkan';
        exit;
    }

    $SHEET_ID = '2PACX-1vSIHXx0HPCr1L-tIzO4TqzwdtzWlFq2ZCO7aTVgyFX0jM3fvqnF8oJlXCdzaCotsfG6O_ze6MZlfy7J';
    $url = "https://docs.google.com/spreadsheets/d/e/{$SHEET_ID}/pub?gid={$gid}&single=true&output=csv";

    $cacheFile = __DIR__ . '/csv_cache_sheet_' . $gid . '.txt';
    $cacheTTL  = 300; // 5 menit

    $forceFresh = isset($_GET['t']);
    if (!$forceFresh && file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheTTL) {
        echo file_get_contents($cacheFile);
        exit;
    }

    $data = fetchCsvData($url);
    if ($data === false || empty(trim($data))) {
        if (file_exists($cacheFile)) { echo file_get_contents($cacheFile); exit; }
        http_response_code(502);
        echo '# ERROR: Gagal mengambil data sheet';
        exit;
    }

    file_put_contents($cacheFile, $data);
    echo $data;
    exit;
}

// ── Mode 1: Default — gabungkan CSV1 + CSV2 (summary) ─────────
$CSV_URLS = [
    'https://docs.google.com/spreadsheets/d/e/2PACX-1vRYWArtmSJU9igeOkV-WvOk9x623BscfGYmXqc9a458gCXPGXMK4tQF7XRb-g5M_x9FQt_3Cg_hFdGz/pub?gid=405205981&single=true&output=csv',
    'https://docs.google.com/spreadsheets/d/e/2PACX-1vSIHXx0HPCr1L-tIzO4TqzwdtzWlFq2ZCO7aTVgyFX0jM3fvqnF8oJlXCdzaCotsfG6O_ze6MZlfy7J/pub?output=csv'
];

$CACHE_FILE = __DIR__ . '/csv_cache.txt';
$CACHE_TTL  = 300;

$forceFresh = isset($_GET['t']);
if (!$forceFresh && file_exists($CACHE_FILE) && (time() - filemtime($CACHE_FILE)) < $CACHE_TTL) {
    echo file_get_contents($CACHE_FILE);
    exit;
}

$csvData = '';
foreach ($CSV_URLS as $url) {
    $res = fetchCsvData($url);
    if ($res !== false) $csvData .= $res . "\n";
}

if (empty($csvData)) {
    if (file_exists($CACHE_FILE)) { echo file_get_contents($CACHE_FILE); exit; }
    http_response_code(502);
    echo '# ERROR: Gagal mengambil data CSV dari Google Sheets';
    exit;
}

file_put_contents($CACHE_FILE, $csvData);
echo $csvData;
