<?php
if (!session_id()) session_start();
// Menggunakan path absolut untuk menghindari kesalahan pencarian folder
require_once __DIR__ . '/app/init.php';
$app = new App();