<?php
/**
 * deploy_laporan.php — Script deploy darurat untuk subdomain laporan.maal
 * Mengambil file terbaru dari GitHub dan menyimpan ke direktori subdomain
 * 
 * PENGGUNAAN: akses https://maal.ppmawar.or.id/deploy_laporan.php?token=MAWARdeploy2024
 */

$TOKEN = 'MAWARdeploy2024';
$GITHUB_RAW = 'https://raw.githubusercontent.com/it-ppmawar/maal.ppmawar.or.id/main/laporan_maal/';

header('Content-Type: text/plain; charset=utf-8');

// Token check
$token = isset($_GET['token']) ? trim($_GET['token']) : '';
if ($token !== $TOKEN) {
    http_response_code(403);
    echo "AKSES DITOLAK\n";
    exit;
}

echo "=== DEPLOY LAPORAN.MAAL ===\n";
echo date('Y-m-d H:i:s') . "\n\n";

// Cari direktori subdomain
$docRoot = $_SERVER['DOCUMENT_ROOT'];
echo "Document root: $docRoot\n";

// cPanel biasanya: /home/username/public_html → subdomain di /home/username/laporan.maal.ppmawar.or.id
$homeDir = dirname(dirname($docRoot));
echo "Home dir: $homeDir\n";

$possibleDirs = [
    $homeDir . '/laporan.maal.ppmawar.or.id',
    $homeDir . '/laporan.maal.ppmawar.or.id/public_html',
    $docRoot . '/laporan_maal',
    dirname($docRoot) . '/laporan.maal.ppmawar.or.id',
];

$subdomainDir = null;
foreach ($possibleDirs as $dir) {
    echo "Checking: $dir → ";
    if (is_dir($dir)) {
        echo "EXISTS\n";
        $subdomainDir = $dir;
        break;
    } else {
        echo "not found\n";
    }
}

if (!$subdomainDir) {
    echo "\nERROR: Subdomain directory tidak ditemukan!\n";
    echo "\nListing home dir:\n";
    if (is_dir($homeDir)) {
        foreach (scandir($homeDir) as $f) {
            if ($f === '.' || $f === '..') continue;
            $p = $homeDir . '/' . $f;
            echo "  " . (is_dir($p) ? "[DIR] " : "[FILE] ") . $f . "\n";
        }
    }
    exit;
}

echo "\nTarget dir: $subdomainDir\n\n";

// Files yang akan di-deploy
$files = ['index.html', 'csv_proxy.php', '.htaccess'];

// Download function
function downloadGithub($url) {
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_USERAGENT => 'Mozilla/5.0',
        ]);
        $data = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($code === 200) ? $data : false;
    }
    // Fallback
    $ctx = stream_context_create([
        'ssl' => ['verify_peer' => false, 'verify_peer_name' => false],
        'http' => ['timeout' => 30, 'user_agent' => 'Mozilla/5.0']
    ]);
    $data = @file_get_contents($url, false, $ctx);
    return $data !== false ? $data : false;
}

// Deploy setiap file
$success = 0;
$fail = 0;
foreach ($files as $file) {
    $url = $GITHUB_RAW . $file;
    echo "Downloading: $file ... ";
    $data = downloadGithub($url);
    if ($data === false || strlen($data) < 100) {
        echo "GAGAL (empty/error)\n";
        $fail++;
        continue;
    }
    
    $targetPath = $subdomainDir . '/' . $file;
    $written = file_put_contents($targetPath, $data);
    if ($written !== false) {
        echo "OK ($written bytes)\n";
        $success++;
    } else {
        echo "GAGAL TULIS ke $targetPath\n";
        $fail++;
    }
}

echo "\n=== HASIL ===\n";
echo "Berhasil: $success file\n";
echo "Gagal: $fail file\n";

echo "\n=== ISI DIREKTORI SETELAH DEPLOY ===\n";
foreach (scandir($subdomainDir) as $f) {
    if ($f === '.' || $f === '..') continue;
    $p = $subdomainDir . '/' . $f;
    if (is_file($p)) {
        echo "  $f (" . filesize($p) . " bytes) - " . date("Y-m-d H:i:s", filemtime($p)) . "\n";
    }
}

echo "\nSelesai: " . date('Y-m-d H:i:s') . "\n";
