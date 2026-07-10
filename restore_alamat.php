<?php
/**
 * restore_alamat.php
 * Restore alamat dari SQL dump asli ke database
 * Cara pakai: upload ppmawaro_maal.sql ke root cPanel, lalu akses:
 * https://maal.ppmawar.or.id/restore_alamat.php?token=MAWARsync2024
 */

if (($_GET['token'] ?? '') !== 'MAWARsync2024') {
    die('Access denied');
}

set_time_limit(120);
header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Restore Alamat</title>';
echo '<style>body{background:#0f172a;color:#e2e8f0;font-family:monospace;padding:20px}';
echo '.ok{color:#4ade80}.err{color:#f87171}.info{color:#94a3b8}</style></head><body>';
echo '<h2 style="color:#60a5fa;">Restore Alamat dari SQL Dump</h2><pre>';

function pr2($msg, $cls = 'info') {
    echo '<span class="' . $cls . '">' . htmlspecialchars($msg) . '</span>' . "\n";
    flush();
}

// ── 1. Cek file SQL dump ──────────────────────────────────────
$dumpPath = __DIR__ . '/ppmawaro_maal.sql';
if (!file_exists($dumpPath)) {
    pr2('ERROR: File ppmawaro_maal.sql tidak ditemukan!', 'err');
    pr2('Silakan upload file ppmawaro_maal.sql ke folder root cPanel.', 'err');
    echo '</pre></body></html>';
    exit;
}
pr2('File SQL dump ditemukan: ' . basename($dumpPath), 'ok');

// ── 2. Koneksi DB ─────────────────────────────────────────────
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=ppmawaro_maal;charset=utf8mb4',
        'ppmawaro_jauhar', 'Mawar20580791',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    pr2('Koneksi database berhasil.', 'ok');
} catch (Exception $e) {
    pr2('GAGAL koneksi DB: ' . $e->getMessage(), 'err');
    echo '</pre></body></html>';
    exit;
}

// ── 3. Baca dan parse SQL dump ────────────────────────────────
pr2('Membaca file SQL dump...', 'info');
$content = file_get_contents($dumpPath);

// Cari blok INSERT INTO uang_wakaf
$startPos = strpos($content, "INSERT INTO `uang_wakaf`");
if ($startPos === false) {
    pr2('ERROR: INSERT block uang_wakaf tidak ditemukan di dump!', 'err');
    echo '</pre></body></html>';
    exit;
}
$endPos  = strpos($content, ';', $startPos);
$block   = substr($content, $startPos, $endPos - $startPos + 1);

// Extract baris: (id, 'nama', 'alamat', nominal, 'tgl')
// Regex: handle alamat kosong '' atau berisi teks
preg_match_all(
    "/\(\s*(\d+)\s*,\s*'([^']*)'\s*,\s*'([^']*)'\s*,\s*(\d+)\s*,\s*'([^']+)'\s*\)/",
    $block,
    $matches,
    PREG_SET_ORDER
);

$total = count($matches);
pr2("Ditemukan $total baris di SQL dump.", 'ok');

// ── 4. Restore alamat ─────────────────────────────────────────
pr2('Memulai restore alamat...', 'info');
$stmt  = $pdo->prepare("UPDATE uang_wakaf SET alamat = :alamat WHERE id = :id");
$count = 0;
$skip  = 0;

foreach ($matches as $row) {
    $id     = (int) $row[1];
    $nama   = trim($row[2]);
    $alamat = $row[3]; // boleh kosong

    try {
        $stmt->execute([':id' => $id, ':alamat' => $alamat]);
        $count++;
    } catch (Exception $e) {
        pr2("ID $id ($nama): " . $e->getMessage(), 'err');
        $skip++;
    }
}

pr2('');
pr2('================================================', 'ok');
pr2("  Berhasil restore : $count baris", 'ok');
pr2("  Gagal            : $skip baris", $skip > 0 ? 'err' : 'info');
pr2('================================================', 'ok');
pr2('Selesai: ' . date('Y-m-d H:i:s'), 'ok');
echo '</pre></body></html>';
