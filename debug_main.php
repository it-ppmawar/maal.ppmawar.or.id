<?php
header('Content-Type: text/plain');
echo "=== SERVER ROOT PATHS ===\n";
echo "Current directory: " . __DIR__ . "\n";
echo "Document root: " . $_SERVER['DOCUMENT_ROOT'] . "\n";

$homeDir = dirname(dirname(dirname(__DIR__)));
echo "Attempting to list home directory: $homeDir\n";
if (is_dir($homeDir)) {
    $files = scandir($homeDir);
    foreach ($files as $f) {
        if ($f === '.' || $f === '..') continue;
        $path = $homeDir . '/' . $f;
        echo "$f - " . (is_dir($path) ? "DIR" : "FILE") . "\n";
    }
} else {
    echo "Could not read home directory.\n";
}

echo "\n=== LISTING SUBDOMAIN DIR ===\n";
$subdomainDir = $homeDir . '/laporan.maal.ppmawar.or.id';
if (is_dir($subdomainDir)) {
    echo "Subdomain dir exists: $subdomainDir\n";
    $files = scandir($subdomainDir);
    foreach ($files as $f) {
        if ($f === '.' || $f === '..') continue;
        $path = $subdomainDir . '/' . $f;
        echo "  $f - " . (is_dir($path) ? "DIR" : "FILE (" . filesize($path) . " bytes)") . " - " . date("Y-m-d H:i:s", filemtime($path)) . "\n";
    }
} else {
    echo "Subdomain dir NOT found at: $subdomainDir\n";
}

echo "\n=== LISTING MAIN APP DIR ===\n";
$mainDir = __DIR__;
$files = scandir($mainDir);
foreach ($files as $f) {
    if ($f === '.' || $f === '..') continue;
    $path = $mainDir . '/' . $f;
    echo "  $f - " . (is_dir($path) ? "DIR" : "FILE (" . filesize($path) . " bytes)") . " - " . date("Y-m-d H:i:s", filemtime($path)) . "\n";
}
