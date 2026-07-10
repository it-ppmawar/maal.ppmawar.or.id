<?php
header('Content-Type: text/plain');
echo "=== SUBDOMAIN ROOT DIRECTORY ===\n";
$files = scandir(__DIR__);
foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;
    echo "$file - " . filesize(__DIR__ . '/' . $file) . " bytes - " . date("Y-m-d H:i:s", filemtime(__DIR__ . '/' . $file)) . "\n";
}

echo "\n=== INDEX.HTML PREVIEW ===\n";
if (file_exists(__DIR__ . '/index.html')) {
    $content = file_get_contents(__DIR__ . '/index.html');
    echo "Length: " . strlen($content) . " bytes\n";
    // Check some keywords
    echo "Contains parseCSVDirect: " . (strpos($content, 'parseCSVDirect') !== false ? 'YES' : 'NO') . "\n";
    echo "Contains hide-mobile: " . (strpos($content, 'hide-mobile') !== false ? 'YES' : 'NO') . "\n";
    
    // Find CSV_URL in the file
    if (preg_match('/var\s+CSV_URL\s*=\s*[\'"]([^\'"]+)[\'"]/', $content, $matches)) {
        echo "CSV_URL defined: " . $matches[1] . "\n";
        
        // Fetch CSV from the server side
        echo "\n=== SERVER-SIDE FETCH OF CSV ===\n";
        $csvContent = @file_get_contents($matches[1]);
        if ($csvContent === false) {
            echo "Failed to fetch CSV from URL: " . $matches[1] . "\n";
        } else {
            echo "Successfully fetched CSV. Length: " . strlen($csvContent) . " bytes\n";
            // Print first 5 lines
            $lines = explode("\n", $csvContent);
            echo "First 5 lines:\n";
            for ($i = 0; $i < min(5, count($lines)); $i++) {
                echo "Line " . ($i+1) . ": " . substr($lines[$i], 0, 100) . "...\n";
            }
        }
    } else {
        echo "CSV_URL NOT FOUND IN INDEX.HTML\n";
    }
} else {
    echo "index.html not found!\n";
}
