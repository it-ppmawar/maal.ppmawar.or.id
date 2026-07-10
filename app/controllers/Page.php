<?php

class Page extends Controller
{
    public function wakaf_uang()
    {
        $this->view('template/p_head');
        $this->view('public/v_uang');
        $this->view('template/p_footer');
        $this->view('public/js_uang');
    }

    public function data_uang()
    {
        $data = $this->model('mPublic')->listUang();
        $kirim = array();
        $i = 1;
        foreach ($data as $dat) {
            $nominal = 'Rp. ' . number_format($dat->nominal, 0, ",", ".");
            $kirim[] = [
                'no'          => $i,
                'nama'        => trim($dat->nama),
                'alamat'      => $dat->alamat ?? '',
                'nominal'     => $nominal,
                'nominal_raw' => (int)$dat->nominal,
                'tgl'         => $dat->tgl,
                'tgl_fmt'     => date('d/m/Y', strtotime($dat->tgl)),
            ];
            $i++;
        }
        echo json_encode($kirim);
    }

    public function data_toko()
    {
        $data = $this->model('mPublic')->listToko();
        $kirim = array();
        $i = 1;
        foreach ($data as $dat) {
            $laba = number_format($dat->laba, 0, ",", ".");
            $link = explode('#', $dat->link);
            if (count($link) >= 2) {
                $klik = '<a target="_blank" href="' . $link[0] . '">' . $link[1] . '</a>';
            } else {
                $klik = htmlspecialchars($dat->link);
            }
            $kirim[] = [
                'no' => $i,
                'tahun' => $dat->tahun,
                'laba' => $laba,
                'persen' => $dat->persen . ' %',
                'ket' => $dat->ket,
                'link' => $klik
            ];
            $i++;
        }

        echo json_encode($kirim);
    }

    public function data_aset()
    {
        $data = $this->model('mPublic')->listAset();
        $kirim = array();
        $i = 1;
        foreach ($data as $dat) {
            $dok = str_replace('#', '<br>', $dat->dok);
            $kirim[] = [
                'no' => $i,
                'uraian' => $dat->uraian,
                'dok' => $dok,
                'ket' => $dat->ket,
            ];
            $i++;
        }

        echo json_encode($kirim);
    }

    /**
     * Ambil data Wakaf Aset langsung dari Google Sheets (pubhtml),
     * lengkap dengan hyperlink ke dokumen Google Drive.
     * URL: /page/data_aset_gsheet
     */
    public function data_aset_gsheet()
    {
        header('Content-Type: application/json; charset=utf-8');

        /* ── 1. Ambil data DB → map berdasarkan ID ── */
        $dbRaw = $this->model('mPublic')->listAset();
        $dbMap = [];
        foreach ($dbRaw as $r) {
            $dbMap[$r->id] = [
                'dok' => str_replace('#', '<br>', $r->dok),
                'ket' => (isset($r->ket) && $r->ket !== '' && $r->ket !== '-') ? $r->ket : '-',
            ];
        }

        /* ── 2. Ambil HTML Google Sheets ── */
        $sheetUrl = 'https://docs.google.com/spreadsheets/d/e/'
                  . '2PACX-1vRYWArtmSJU9igeOkV-WvOk9x623BscfGYmXqc9a458gCXPGXMK4tQF7XRb-g5M_x9FQt_3Cg_hFdGz'
                  . '/pubhtml/sheet?headers=false&gid=845888523';

        $html = '';
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt_array($ch, [
                CURLOPT_URL            => $sheetUrl,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT        => 30,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_USERAGENT      => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
            ]);
            $html = curl_exec($ch);
            curl_close($ch);
        } else {
            $ctx  = stream_context_create(['ssl' => ['verify_peer' => false]]);
            $html = @file_get_contents($sheetUrl, false, $ctx);
        }

        if (empty($html)) {
            echo json_encode(['error' => 'Gagal mengambil data dari Google Sheets']);
            return;
        }

        /* ── 3. Parse HTML ── */
        libxml_use_internal_errors(true);
        $dom = new DOMDocument();
        $dom->loadHTML('<?xml encoding="utf-8" ?>' . $html);
        libxml_clear_errors();

        /* Helper: ekstrak link dan format sebagai badge */
        $extractDocBadges = function($cell, $labelNumber) {
            if (!$cell) return [];
            $anchors = $cell->getElementsByTagName('a');
            $badges = [];
            if ($anchors->length > 0) {
                $idx = 1;
                foreach ($anchors as $a) {
                    $href = $a->getAttribute('href');
                    if (preg_match('/[?&]q=([^&]+)/', $href, $m)) {
                        $url = urldecode($m[1]);
                    } else {
                        $url = $href;
                    }
                    $suffix = ($anchors->length > 1) ? '.' . $idx++ : '';
                    $badges[] = '<a href="' . htmlspecialchars($url, ENT_QUOTES, 'UTF-8')
                              . '" target="_blank" rel="noopener" class="badge badge-primary">'
                              . 'Keterangan ' . $labelNumber . $suffix . '</a>';
                }
            } else {
                $text = trim($cell->textContent);
                if ($text !== '' && $text !== '-') {
                    $badges[] = '<span class="badge badge-secondary">' . htmlspecialchars($text, ENT_QUOTES, 'UTF-8') . '</span>';
                }
            }
            return $badges;
        };

        $data       = [];
        $skipHeader = true;

        foreach ($dom->getElementsByTagName('tr') as $row) {
            $tds = $row->getElementsByTagName('td');
            if ($tds->length < 2) continue;

            $noText = trim($tds->item(0)->textContent);
            if ($skipHeader) { $skipHeader = false; continue; }
            if (!is_numeric($noText)) continue;

            $no     = (int)$noText;
            $uraian = trim($tds->item(1)->textContent);

            /* Link dari Google Sheets (empat kolom) */
            $badges1 = $extractDocBadges($tds->item(2), 1);
            $badges2 = $extractDocBadges($tds->item(3), 2);
            $badges3 = $extractDocBadges($tds->item(4), 3);
            $badges4 = $extractDocBadges($tds->item(5), 4);

            /* ── 4. Susun kolom DOKUMEN: teks DB ── */
            $dokParts = [];

            /* (a) Teks deskriptif dari DB (jika baris ini ada di DB) */
            if (isset($dbMap[$no]) && $dbMap[$no]['dok'] !== '') {
                $dokParts[] = $dbMap[$no]['dok'];
            }

            /* Kolom KETERANGAN: link GSheet berlabel badge + teks DB */
            $ketParts = [];
            $linksList = array_merge($badges1, $badges2, $badges3, $badges4);
            if (!empty($linksList)) {
                $ketParts[] = implode(' &nbsp; ', $linksList);
            }
            if (isset($dbMap[$no]) && $dbMap[$no]['ket'] !== '' && $dbMap[$no]['ket'] !== '-') {
                $ketParts[] = $dbMap[$no]['ket'];
            }

            $data[] = [
                'no'     => $no,
                'uraian' => $uraian,
                'dok'    => implode('<br>', $dokParts),
                'ket'    => !empty($ketParts) ? implode('<br>', $ketParts) : '-',
            ];
        }

        echo json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
    public function data_polis()
    {
        $data = $this->model('mPublic')->listPolis();
        $kirim = array();
        $i = 1;
        foreach ($data as $dat) {
            $ket = str_replace('#', '<br>', $dat->ket);
            $nominal = number_format($dat->nominal, 0, ",", ".");
            $tgl = date('d/m/Y', strtotime($dat->tgl));

            $kirim[] = [
                'no' => $i,
                'wakif' => $dat->wakif,
                'nominal' => $nominal,
                'tgl' => $tgl,
                'ket' => $ket,
            ];
            $i++;
        }

        echo json_encode($kirim);
    }

    public function wakaf_polis()
    {
        $this->view('template/p_head');
        $this->view('public/v_polis');
        $this->view('template/p_footer');
        $this->view('public/js_polis');
    }

    public function wakaf_asset()
    {
        $this->view('template/p_head');
        $this->view('public/v_aset');
        $this->view('template/p_footer');
        $this->view('public/js_aset');
    }

    public function wakaf_basmalah()
    {
        $this->view('template/p_head');
        $this->view('public/v_toko');
        $this->view('template/p_footer');
        $this->view('public/js_toko');
    }
    
    // Tambahkan di dalam class Page (Page.php)
    public function perkembangan()
    {
        $this->view('template/p_head');
        $this->view('public/v_perkembangan');
        $this->view('template/p_footer');
        $this->view('public/js_perkembangan');
    }

    public function wakaf_uang_detail()
    {
        $this->view('template/p_head');
        $this->view('public/v_uang_detail');
        $this->view('template/p_footer');
        $this->view('public/js_uang_detail');
    }
}
