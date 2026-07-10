<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>Tes Koneksi Google Sheets</h1>";

$csvUrl = "https://docs.google.com/spreadsheets/d/e/2PACX-1vRYWArtmSJU9igeOkV-WvOk9x623BscfGYmXqc9a458gCXPGXMK4tQF7XRb-g5M_x9FQt_3Cg_hFdGz/pub?gid=1691203344&single=true&output=csv";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $csvUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$content = curl_exec($ch);

if(curl_errno($ch)){
    echo 'Curl error: ' . curl_error($ch);
} else {
    echo "Berhasil menarik data! <br>";
    echo "<pre>" . substr($content, 0, 500) . "</pre>";
}
curl_close($ch);