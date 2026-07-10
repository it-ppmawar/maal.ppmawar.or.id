<?php
/**
 * sync_gsheet.php — Sinkronisasi SATU ARAH GSheet → MySQL (uang_wakaf)
 *
 * STRATEGI BARU (aman):
 *  - Cocokkan by (nama + tgl), BUKAN by id/No
 *  - UPDATE nama & nominal jika baris ditemukan
 *  - UPDATE alamat HANYA jika DB alamat masih kosong
 *  - INSERT jika baris belum ada di DB (id auto-increment)
 *  - TIDAK PERNAH menimpa alamat yang sudah ada di DB
 */

set_time_limit(300);
ini_set('display_errors', 1);
error_reporting(E_ALL);

$SYNC_TOKEN = 'MAWARsync2024';
$DB_HOST    = 'localhost';
$DB_USER    = 'ppmawaro_jauhar';
$DB_PASS    = 'Mawar20580791';
$DB_NAME    = 'ppmawaro_maal';
$CSV_URL    = 'https://docs.google.com/spreadsheets/d/e/'
            . '2PACX-1vRYWArtmSJU9igeOkV-WvOk9x623BscfGYmXqc9a458gCXPGXMK4tQF7XRb-g5M_x9FQt_3Cg_hFdGz'
            . '/pub?gid=279721120&single=true&output=csv';

// ── HTML output ────────────────────────────────────────────────
header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Sync GSheet</title>';
echo '<style>body{background:#0f172a;color:#e2e8f0;font-family:monospace;padding:20px}';
echo 'h2{color:#60a5fa;font-family:sans-serif}pre{background:#1e293b;border:1px solid #334155;';
echo 'border-radius:8px;padding:16px;max-width:900px;white-space:pre-wrap}';
echo '.ok{color:#4ade80}.err{color:#f87171}.warn{color:#facc15}.info{color:#94a3b8}.head{color:#93c5fd;font-weight:bold}';
echo '</style></head><body><h2>Sync Google Sheets &rarr; MySQL | MAAL PPMAWAR</h2><pre>';

function pr($msg, $cls = 'info') {
    echo '<span class="' . $cls . '">' . htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') . '</span>' . "\n";
    flush();
}

// Normalisasi key untuk matching (nama + tgl)
function makeKey($nama, $tgl) {
    return strtolower(trim(preg_replace('/\s+/', ' ', $nama))) . '|' . trim($tgl);
}

// ── 1. Token ───────────────────────────────────────────────────
echo "<!-- MAWAR_DEBUG_SYNC_V2 -->\n";
pr('==================================================', 'head');
pr('  ' . date('Y-m-d H:i:s'), 'head');
pr('==================================================', 'head');
$token = isset($_GET['token']) ? trim($_GET['token']) : '';
if ($token !== $SYNC_TOKEN) {
    pr('[!] AKSES DITOLAK.', 'err');
    echo '</pre></body></html>';
    exit;
}
pr('[1] Token: OK', 'ok');

// ── 2. Koneksi DB ──────────────────────────────────────────────
pr('[2] Koneksi database...', 'info');
try {
    $pdo = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8mb4", $DB_USER, $DB_PASS,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    pr('    Berhasil.', 'ok');
} catch (Exception $e) {
    pr('    GAGAL: ' . $e->getMessage(), 'err');
    echo '</pre></body></html>';
    exit;
}

// ── 4. Load semua data DB ke memory (untuk lookup) ─────────────
pr('[4] Membaca data DB yang sudah ada...', 'info');
$dbMap  = array();
$maxId  = 0;
$stmt   = $pdo->query("SELECT id, TRIM(nama) AS nama, tgl, nominal, COALESCE(alamat,'') AS alamat FROM uang_wakaf");
while ($r = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $k = makeKey($r['nama'], $r['tgl']);
    $dbMap[$k] = $r;
    if ((int)$r['id'] > $maxId) $maxId = (int)$r['id'];
}
$nextId = $maxId + 1; // id untuk INSERT baru
pr('    Total baris di DB saat ini: ' . count($dbMap) . ' | MAX id: ' . $maxId, 'ok');

// ── 5. Fetch CSV ───────────────────────────────────────────────
pr('[5] Mengambil CSV dari Google Sheets...', 'info');
$csvRaw = false;
if (function_exists('curl_init')) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $CSV_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    $csvRaw   = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    pr('    HTTP: ' . $httpCode, $httpCode == 200 ? 'ok' : 'err');
} else {
    $ctx    = stream_context_create(array('ssl' => array('verify_peer' => false)));
    $csvRaw = @file_get_contents($CSV_URL, false, $ctx);
}
if (empty($csvRaw)) {
    pr('    GAGAL: Tidak ada data.', 'err');
    echo '</pre></body></html>';
    exit;
}
pr('    Data: ' . strlen($csvRaw) . ' bytes', 'ok');

// ── 6. Parse CSV ───────────────────────────────────────────────
pr('[6] Mem-parse CSV...', 'info');
$csvRaw  = str_replace(array("\r\n", "\r"), "\n", $csvRaw);
$lines   = explode("\n", $csvRaw);
$allRows = array();
foreach ($lines as $ln) {
    $ln = trim($ln);
    if ($ln !== '') $allRows[] = str_getcsv($ln);
}
$header     = array_shift($allRows); // buang header row
$totalBaris = count($allRows);
pr('    Header: ' . implode(' | ', array_slice($header, 0, 5)), 'info');
pr('    Data: ' . $totalBaris . ' baris', 'ok');

// ── 7. Prepared statements ─────────────────────────────────────
// UPDATE: hanya nama & nominal; alamat hanya jika DB kosong
$stmUpdate = $pdo->prepare(
    "UPDATE uang_wakaf SET
        nama    = :nama,
        nominal = :nominal,
        alamat  = CASE WHEN (alamat IS NULL OR TRIM(alamat) = '') AND :alamat != ''
                       THEN :alamat ELSE alamat END
     WHERE id = :id"
);
// INSERT baru: id eksplisit (MAX+counter), tidak perlu AUTO_INCREMENT
$stmInsert = $pdo->prepare(
    "INSERT INTO uang_wakaf (id, nama, alamat, nominal, tgl)
     VALUES (:id, :nama, :alamat, :nominal, :tgl)"
);

// ── 8. Loop UPSERT ─────────────────────────────────────────────
pr('[7] Proses UPSERT...', 'info');
$cInsert = 0; $cUpdate = 0; $cSame = 0; $cSkip = 0; $cErr = 0;
$errList = array();

foreach ($allRows as $cols) {
    // Kolom: 0=No, 1=Nama, 2=Alamat, 3=Nilai Wajar, 4=Tgl
    $nama    = trim(isset($cols[1]) ? $cols[1] : '');
    $alamat  = trim(isset($cols[2]) ? $cols[2] : '');
    $nominal = trim(isset($cols[3]) ? $cols[3] : '');
    $tgl     = trim(isset($cols[4]) ? $cols[4] : '');

    if ($nama === '' || $tgl === '') { $cSkip++; continue; }

    $nominal = (int)preg_replace('/[^0-9]/', '', $nominal);

    // Validasi tanggal YYYY-MM-DD
    $d = DateTime::createFromFormat('Y-m-d', $tgl);
    if (!$d || $d->format('Y-m-d') !== $tgl) { $cSkip++; continue; }

    $key = makeKey($nama, $tgl);

    try {
        if (isset($dbMap[$key])) {
            $existing = $dbMap[$key];
            // Cek apakah ada yang berubah
            if ((int)$existing['nominal'] !== $nominal || $existing['alamat'] === '' && $alamat !== '') {
                $stmUpdate->execute(array(
                    ':id'      => $existing['id'],
                    ':nama'    => $nama,
                    ':nominal' => $nominal,
                    ':alamat'  => $alamat,
                ));
                $cUpdate++;
            } else {
                $cSame++;
            }
        } else {
            $stmInsert->execute(array(
                ':id'      => $nextId,
                ':nama'    => $nama,
                ':alamat'  => $alamat,
                ':nominal' => $nominal,
                ':tgl'     => $tgl,
            ));
            $nextId++;
            $cInsert++;
        }
    } catch (Exception $e) {
        $errList[] = "[$nama / $tgl]: " . $e->getMessage();
        $cErr++;
    }
}

// ── 9. Hasil ───────────────────────────────────────────────────
pr('');
pr('==================================================', 'head');
pr('  HASIL SINKRONISASI', 'head');
pr('==================================================', 'head');
pr('  Total baris GSheet  : ' . $totalBaris);
pr('  INSERT baru         : ' . $cInsert,  $cInsert > 0 ? 'ok'   : 'info');
pr('  UPDATE              : ' . $cUpdate,  $cUpdate > 0 ? 'ok'   : 'info');
pr('  Tidak berubah       : ' . $cSame,   'info');
pr('  Dilewati (skip)     : ' . $cSkip,    $cSkip   > 0 ? 'warn' : 'info');
pr('  Error               : ' . $cErr,     $cErr    > 0 ? 'err'  : 'info');
pr('==================================================', 'head');

foreach (array_slice($errList, 0, 20) as $e) pr('  > ' . $e, 'err');

pr('');
pr('Selesai: ' . date('Y-m-d H:i:s'), 'ok');
echo '</pre></body></html>';
