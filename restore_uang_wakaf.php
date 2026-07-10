<?php
/**
 * restore_uang_wakaf.php
 * Restore SELURUH data uang_wakaf dari SQL dump
 * (hanya INSERT, tanpa CREATE TABLE)
 * 
 * Akses: https://maal.ppmawar.or.id/restore_uang_wakaf.php?token=MAWARsync2024
 * Pastikan ppmawaro_maal.sql sudah ada di folder root
 */

if (($_GET['token'] ?? '') !== 'MAWARsync2024') {
    die('Access denied');
}

set_time_limit(120);
header('Content-Type: text/html; charset=utf-8');
echo '<!DOCTYPE html><html><head><meta charset="UTF-8"><title>Restore uang_wakaf</title>';
echo '<style>body{background:#0f172a;color:#e2e8f0;font-family:monospace;padding:20px}';
echo '.ok{color:#4ade80}.err{color:#f87171}.info{color:#94a3b8}.head{color:#93c5fd;font-weight:bold}</style></head><body>';
echo '<h2 style="color:#60a5fa;">Restore Data uang_wakaf dari SQL Dump</h2><pre>';

function p($msg, $cls = 'info') {
    echo '<span class="' . $cls . '">' . htmlspecialchars($msg) . '</span>' . "\n";
    flush();
}

// ── 1. Cek file SQL dump ──────────────────────────────────────
$dumpPath = __DIR__ . '/ppmawaro_maal.sql';
if (!file_exists($dumpPath)) {
    p('ERROR: File ppmawaro_maal.sql tidak ditemukan!', 'err');
    p('Upload file ppmawaro_maal.sql ke folder root cPanel.', 'err');
    echo '</pre></body></html>';
    exit;
}
p('File SQL dump ditemukan.', 'ok');

// ── 2. Koneksi DB ─────────────────────────────────────────────
try {
    $pdo = new PDO(
        'mysql:host=localhost;dbname=ppmawaro_maal;charset=utf8mb4',
        'ppmawaro_jauhar', 'Mawar20580791',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    p('Koneksi database berhasil.', 'ok');
} catch (Exception $e) {
    p('GAGAL koneksi DB: ' . $e->getMessage(), 'err');
    echo '</pre></body></html>';
    exit;
}

// ── 3. Ambil INSERT block untuk uang_wakaf ────────────────────
p('Membaca SQL dump...', 'info');
$content = file_get_contents($dumpPath);

// Cari posisi INSERT INTO `uang_wakaf`
$startPos = strpos($content, "INSERT INTO `uang_wakaf`");
if ($startPos === false) {
    p('ERROR: INSERT block uang_wakaf tidak ditemukan!', 'err');
    echo '</pre></body></html>';
    exit;
}

// Ambil sampai titik koma penutup
$endPos     = strpos($content, ';', $startPos);
$insertSQL  = substr($content, $startPos, $endPos - $startPos + 1);
p('INSERT block berhasil ditemukan.', 'ok');

// ── 4. Cek jumlah baris saat ini ─────────────────────────────
$current = $pdo->query("SELECT COUNT(*) FROM uang_wakaf")->fetchColumn();
p("Jumlah baris saat ini di DB: $current", 'info');

// ── 5. Kosongkan tabel dulu ───────────────────────────────────
if ((int)$current > 0) {
    p('Mengosongkan tabel uang_wakaf...', 'info');
    $pdo->exec("SET FOREIGN_KEY_CHECKS=0");
    $pdo->exec("TRUNCATE TABLE `uang_wakaf`");
    $pdo->exec("SET FOREIGN_KEY_CHECKS=1");
    p('Tabel berhasil dikosongkan.', 'ok');
} else {
    p('Tabel sudah kosong, lanjut INSERT.', 'info');
}

// ── 6. Pastikan PRIMARY KEY ada ───────────────────────────────
try {
    $r = $pdo->query("
        SELECT COUNT(*) AS c FROM information_schema.TABLE_CONSTRAINTS
        WHERE TABLE_SCHEMA='ppmawaro_maal'
          AND TABLE_NAME='uang_wakaf'
          AND CONSTRAINT_TYPE='PRIMARY KEY'
    ")->fetch(PDO::FETCH_OBJ);
    if ($r->c == 0) {
        $pdo->exec("ALTER TABLE `uang_wakaf` ADD PRIMARY KEY (`id`)");
        p('PRIMARY KEY ditambahkan.', 'ok');
    } else {
        p('PRIMARY KEY sudah ada.', 'ok');
    }
} catch (Exception $e) {
    p('Peringatan PRIMARY KEY: ' . $e->getMessage(), 'info');
}

// ── 7. Jalankan INSERT ────────────────────────────────────────
p('Menjalankan INSERT data asli...', 'info');
try {
    $pdo->exec($insertSQL);
    $jumlah = $pdo->query("SELECT COUNT(*) FROM uang_wakaf")->fetchColumn();
    p('');
    p('================================================', 'head');
    p('  RESTORE SELESAI!', 'head');
    p("  Total baris berhasil di-restore: $jumlah", 'ok');
    p('================================================', 'head');
    p('');
    p('Selesai: ' . date('Y-m-d H:i:s'), 'ok');
} catch (Exception $e) {
    p('GAGAL INSERT: ' . $e->getMessage(), 'err');
}

echo '</pre></body></html>';
