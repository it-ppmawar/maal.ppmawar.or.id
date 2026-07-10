<?php
// FILE DEBUG - Hapus setelah digunakan
header('Content-Type: text/plain; charset=utf-8');

echo "=== DEBUG SERVER ===\n";
echo "__FILE__: " . __FILE__ . "\n";
echo "__DIR__: " . __DIR__ . "\n";
echo "DOCUMENT_ROOT: " . $_SERVER['DOCUMENT_ROOT'] . "\n";
echo "SCRIPT_FILENAME: " . $_SERVER['SCRIPT_FILENAME'] . "\n";
echo "PHP_SELF: " . $_SERVER['PHP_SELF'] . "\n";

echo "\n=== HOME DIR LISTING ===\n";
$homeDir = dirname(dirname($_SERVER['DOCUMENT_ROOT']));
echo "Home dir: $homeDir\n";
if (is_dir($homeDir)) {
    foreach (scandir($homeDir) as $f) {
        if ($f === '.' || $f === '..') continue;
        $p = $homeDir . '/' . $f;
        echo (is_dir($p) ? "[DIR] " : "[FILE] ") . $f . "\n";
    }
} else {
    echo "Tidak bisa akses: $homeDir\n";
}

echo "\n=== SUBDOMAIN CHECK ===\n";
$possibleSubdomains = [
    $homeDir . '/laporan.maal.ppmawar.or.id',
    dirname($_SERVER['DOCUMENT_ROOT']) . '/laporan.maal.ppmawar.or.id',
    $_SERVER['DOCUMENT_ROOT'] . '/laporan_maal',
];
foreach ($possibleSubdomains as $d) {
    echo $d . " -> " . (is_dir($d) ? "ADA" : "tidak ada") . "\n";
    if (is_dir($d)) {
        foreach (scandir($d) as $f) {
            if ($f === '.' || $f === '..') continue;
            $p = $d . '/' . $f;
            echo "  $f (" . (is_file($p) ? filesize($p) . " bytes, " . date("Y-m-d H:i:s", filemtime($p)) : "DIR") . ")\n";
        }
    }
}
