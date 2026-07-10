<?php

class Home extends Controller {
    public function index() {
        $this->view('template/all');
    }

    public function get_grafik() {
        $csvUrl = "https://docs.google.com/spreadsheets/d/e/2PACX-1vRYWArtmSJU9igeOkV-WvOk9x623BscfGYmXqc9a458gCXPGXMK4tQF7XRb-g5M_x9FQt_3Cg_hFdGz/pub?gid=1691203344&single=true&output=csv";
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $csvUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $content = curl_exec($ch);
        curl_close($ch);

        $uang = array();
        $hasil = array();
        $penyaluran = array();

        if ($content) {
            $lines = explode("\n", $content);
            foreach ($lines as $line) {
                // ... di dalam foreach ($lines as $line)
                $data = str_getcsv($line);
                if (isset($data[1]) && is_numeric(trim($data[1]))) {
                    $tahun = trim($data[1]);
                    if ($tahun >= 2009) {
                        $uang[$tahun] = (int)preg_replace('/[^0-9]/', '', isset($data[10]) ? $data[10] : '0');
                        
                        // Mengambil kolom Q (index 16) untuk Persentase Hasil
                        // Kita hilangkan tanda '%' dan ganti koma dengan titik untuk format desimal PHP
                        $rawPersenHasil = isset($data[16]) ? str_replace(array('%', ','), array('', '.'), $data[16]) : '0';
                        $hasil[$tahun] = (float)trim($rawPersenHasil);
                
                        $penyaluran[$tahun] = (int)preg_replace('/[^0-9]/', '', isset($data[21]) ? $data[21] : '0');
                    }
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode(array(
            'uang' => $uang,
            'hasil' => $hasil,
            'penyaluran' => $penyaluran,
            'basmalah' => $this->model('mPublic')->getBasmalah()
        ));
        exit;
    }
}