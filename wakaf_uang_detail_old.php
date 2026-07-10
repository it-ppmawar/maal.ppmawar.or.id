<?php
// ============================================================
// DATA STATIS FALLBACK — tampil langsung, diperbarui oleh JS
// jika Google Apps Script berhasil diakses dari browser
// Data diperbarui: April 2026 (95 akun)
// ============================================================
$akun_list = [
    ['no'=>1,  'nama'=>'Wakaf PPMA',                                      'icon'=>'bx-home-heart',    'data'=>['2020'=>397154884,'2021'=>657312884,'2022'=>1000000000,'2023'=>1094000000,'2024'=>1197911000,'2025'=>1208311000,'2026'=>2268511000]],
    ['no'=>2,  'nama'=>'Wakaf PPMA Asrama A',                             'icon'=>'bx-building-house','data'=>['2020'=>200000000,'2021'=>214575000,'2022'=>326046000,'2023'=>450742000,'2024'=>568181000,'2025'=>584360000,'2026'=>598780000]],
    ['no'=>3,  'nama'=>'Wakaf PPMA Asrama C',                             'icon'=>'bx-building-house','data'=>['2020'=>8183825,'2021'=>8779825,'2022'=>13988825,'2023'=>14500826,'2024'=>29802826,'2025'=>80303826,'2026'=>120723826]],
    ['no'=>4,  'nama'=>'Wakaf Air Galon Mato',                            'icon'=>'bx-droplet',       'data'=>['2020'=>20000000,'2021'=>121457000,'2022'=>327950000,'2023'=>474965000,'2024'=>504911000,'2025'=>539911000,'2026'=>551931000]],
    ['no'=>5,  'nama'=>'Wakaf Pengelolaan Sampah',                        'icon'=>'bx-recycle',       'data'=>['2020'=>100005000,'2021'=>107292000,'2022'=>153027000,'2023'=>233633000,'2024'=>298525000,'2025'=>298525000,'2026'=>305145000]],
    ['no'=>6,  'nama'=>'Wakaf POM Mini',                                  'icon'=>'bx-gas-pump',      'data'=>['2020'=>9600000,'2021'=>10299000,'2022'=>10849000,'2023'=>11246000,'2024'=>11481000,'2025'=>11481000,'2026'=>11701000]],
    ['no'=>7,  'nama'=>'Wakaf Terop PPMA',                                'icon'=>'bx-home',          'data'=>['2020'=>22720000,'2021'=>24375000,'2022'=>25678000,'2023'=>46738000,'2024'=>72716000,'2025'=>72716000,'2026'=>74236000]],
    ['no'=>8,  'nama'=>'Wakaf Kantin Asrama A',                           'icon'=>'bx-store',         'data'=>['2020'=>2600000,'2021'=>2789000,'2022'=>2938000,'2023'=>5545000,'2024'=>5660000,'2025'=>6192000,'2026'=>6312000]],
    ['no'=>9,  'nama'=>'Wakaf MA Mawar',                                  'icon'=>'bx-book-open',     'data'=>['2020'=>220270499,'2021'=>276322499,'2022'=>410154499,'2023'=>471181499,'2024'=>504574723,'2025'=>616940723,'2026'=>701071723]],
    ['no'=>10, 'nama'=>'Wakaf Fatayat Muslimat NU Karanggeneng',          'icon'=>'bx-group',         'data'=>['2021'=>383000000,'2022'=>403475000,'2023'=>210930000,'2024'=>215346000,'2025'=>220816000,'2026'=>225736000]],
    ['no'=>11, 'nama'=>'Wakaf Yayasan Bani Muzakki',                      'icon'=>'bx-donate-heart',  'data'=>['2021'=>72100000,'2022'=>128954000,'2023'=>189678000,'2024'=>261650000,'2025'=>330711000,'2026'=>385331000]],
    ['no'=>12, 'nama'=>'Wakaf H. Ali Mustain',                            'icon'=>'bx-user',          'data'=>['2021'=>50000000,'2022'=>62154000,'2023'=>64431000,'2024'=>67779000,'2025'=>72274000,'2026'=>76494000]],
    ['no'=>13, 'nama'=>'Wakaf MI Banin',                                  'icon'=>'bx-library',       'data'=>['2021'=>100000000,'2022'=>105346000,'2023'=>109205000,'2024'=>123491000,'2025'=>131099000,'2026'=>147119000]],
    ['no'=>14, 'nama'=>'Wakaf TKM NU Mawar Simo',                         'icon'=>'bx-church',        'data'=>['2021'=>100000000,'2022'=>105346000,'2023'=>109205000,'2024'=>113491000,'2025'=>117463000,'2026'=>121083000]],
    ['no'=>15, 'nama'=>'Wakaf IKA UNHASY Tebuireng',                      'icon'=>'bx-graduation',    'data'=>['2022'=>66050000,'2023'=>68470000,'2024'=>69903000,'2025'=>71548000,'2026'=>73068000]],
    ['no'=>16, 'nama'=>'Wakaf KBIHU Mawar',                               'icon'=>'bx-trip',          'data'=>['2023'=>53750000,'2024'=>74874000,'2025'=>77337000,'2026'=>79057000]],
    ['no'=>17, 'nama'=>'Wakaf Masjid Mambaut Taqwa Sungelebak',           'icon'=>'bx-buildings',     'data'=>['2023'=>10000000,'2024'=>11209000,'2025'=>26472000,'2026'=>29992000]],
    ['no'=>18, 'nama'=>'Wakaf Masjid Ihyaul Ulum Simo',                   'icon'=>'bx-buildings',     'data'=>['2023'=>10000000,'2024'=>11209000,'2025'=>25572000,'2026'=>26892000]],
    ['no'=>19, 'nama'=>'Wakaf Madin Safa Taslim',                         'icon'=>'bx-book',          'data'=>['2023'=>5000000,'2024'=>5104000,'2025'=>5223000,'2026'=>5663000]],
    ['no'=>20, 'nama'=>'Wakaf PPMA Asrama B',                             'icon'=>'bx-building-house','data'=>['2023'=>15000000,'2024'=>15313000,'2025'=>27772000,'2026'=>93260800]],
    ['no'=>21, 'nama'=>'Wakaf Masjid Roudlotul Muttaqin Mayong',          'icon'=>'bx-buildings',     'data'=>['2023'=>1000000,'2024'=>3020000,'2025'=>8991000,'2026'=>16411000]],
    ['no'=>22, 'nama'=>'Wakaf PP. Darul Falah',                           'icon'=>'bx-home-heart',    'data'=>['2023'=>10000000,'2024'=>12000000,'2025'=>14181000,'2026'=>17796000]],
    ['no'=>23, 'nama'=>'Wakaf KSPPS Mawar Pusat',                         'icon'=>'bx-bank',          'data'=>['2023'=>1000000,'2024'=>17020000,'2025'=>224763707,'2026'=>994763707]],
    ['no'=>24, 'nama'=>'Wakaf KSPPS Mawar Mojokerto',                     'icon'=>'bx-bank',          'data'=>['2023'=>1000000,'2024'=>2000000,'2025'=>2246000,'2026'=>2296000]],
    ['no'=>25, 'nama'=>'Wakaf KSPPS Mawar Sungelebak',                    'icon'=>'bx-bank',          'data'=>['2023'=>1000000,'2024'=>4020000,'2025'=>4814000,'2026'=>5514000]],
    ['no'=>26, 'nama'=>'Wakaf KSPPS Mawar Sumberwudi',                    'icon'=>'bx-bank',          'data'=>['2023'=>1000000,'2024'=>3020000,'2025'=>5791000,'2026'=>7691000]],
    ['no'=>27, 'nama'=>'Wakaf KSPPS Mawar Kiringan',                      'icon'=>'bx-bank',          'data'=>['2023'=>1000000,'2024'=>6020000,'2025'=>10061000,'2026'=>12361000]],
    ['no'=>28, 'nama'=>'Wakaf Masjid NU Husnul Khotimah Morogo',          'icon'=>'bx-buildings',     'data'=>['2023'=>1000000,'2024'=>3020000,'2025'=>8891000,'2026'=>14211000]],
    ['no'=>29, 'nama'=>'Wakaf BMT Mandiri Sejahtera QQ H. M. Ayubi',      'icon'=>'bx-bank',          'data'=>['2023'=>29000000,'2024'=>29606000,'2025'=>40203000,'2026'=>57723000]],
    ['no'=>30, 'nama'=>'Wakaf Masjid AT Taqwa Kuluran',                   'icon'=>'bx-buildings',     'data'=>['2023'=>10000000,'2024'=>11109000,'2025'=>12670000,'2026'=>15290000]],
    ['no'=>31, 'nama'=>'Wakaf PP Darun Nuhat',                            'icon'=>'bx-home-heart',    'data'=>['2023'=>10000000,'2024'=>11358000,'2025'=>12224000,'2026'=>12844000]],
    ['no'=>32, 'nama'=>'Wakaf Masjid AT Taqwa Kendal Sekaran',            'icon'=>'bx-buildings',     'data'=>['2023'=>1000000,'2024'=>3020000,'2025'=>20791000,'2026'=>24511000]],
    ['no'=>33, 'nama'=>'Wakaf Masjid Arrohman Banjaranyar',               'icon'=>'bx-buildings',     'data'=>['2023'=>1000000,'2024'=>1140000,'2025'=>1166000,'2026'=>1166000]],
    ['no'=>34, 'nama'=>'Wakaf SDN 2 Tejoasri Laren',                      'icon'=>'bx-school',        'data'=>['2023'=>1000000,'2024'=>2220000,'2025'=>12971000,'2026'=>13391000]],
    ['no'=>35, 'nama'=>'Wakaf PPMA Asrama E',                             'icon'=>'bx-building-house','data'=>['2023'=>1000000,'2024'=>52020000,'2025'=>58644000,'2026'=>163364000]],
    ['no'=>36, 'nama'=>'Wakaf MI Banat',                                  'icon'=>'bx-library',       'data'=>['2023'=>1000000,'2024'=>2020000,'2025'=>14744000,'2026'=>32164000]],
    ['no'=>37, 'nama'=>'Wakaf PPMA Madrasah Diniyah',                     'icon'=>'bx-book-open',     'data'=>['2024'=>250000000,'2025'=>250400000,'2026'=>256220000]],
    ['no'=>38, 'nama'=>'Wakaf PPMA MQ Tarbiyatul Banat',                  'icon'=>'bx-book-open',     'data'=>['2024'=>50000000,'2025'=>50000000,'2026'=>51120000]],
    ['no'=>39, 'nama'=>'Wakaf Masjid Darussalam Badu Wanar',              'icon'=>'bx-buildings',     'data'=>['2024'=>10000000,'2025'=>10434000,'2026'=>11563000]],
    ['no'=>40, 'nama'=>'Wakaf Masjid Jami AL Hidayah Ketawang',           'icon'=>'bx-buildings',     'data'=>['2024'=>10000000,'2025'=>12734000,'2026'=>14254000]],
    ['no'=>41, 'nama'=>'Wakaf PCNU Babat',                                'icon'=>'bx-group',         'data'=>['2024'=>10000000,'2025'=>10237000,'2026'=>10677000]],
    ['no'=>42, 'nama'=>'Wakaf Masjid Fathul Bari Karangsuko',             'icon'=>'bx-buildings',     'data'=>['2024'=>10000000,'2025'=>10237000,'2026'=>10577000]],
    ['no'=>43, 'nama'=>'Wakaf MI DU Sukosari',                            'icon'=>'bx-library',       'data'=>['2024'=>10000000,'2025'=>10237000,'2026'=>82577000]],
    ['no'=>44, 'nama'=>'Wakaf YPP Jawharot AL Muzakky Sukosari',          'icon'=>'bx-donate-heart',  'data'=>['2024'=>5000000,'2025'=>5119000,'2026'=>5339000]],
    ['no'=>45, 'nama'=>'Wakaf IKAPETE',                                   'icon'=>'bx-group',         'data'=>['2024'=>10000000,'2025'=>10234000,'2026'=>10454000]],
    ['no'=>46, 'nama'=>'Wakaf YPS Raudlatut Thullab',                     'icon'=>'bx-book',          'data'=>['2024'=>10000000,'2025'=>10234000,'2026'=>10654000]],
    ['no'=>47, 'nama'=>'Wakaf Yayasan Al Anwari Banyuwangi',              'icon'=>'bx-donate-heart',  'data'=>['2024'=>10000000,'2025'=>10234000,'2026'=>10454000]],
    ['no'=>48, 'nama'=>'Wakaf MWC NU Karanggeneng',                       'icon'=>'bx-group',         'data'=>['2025'=>10000000,'2026'=>10320000]],
    ['no'=>49, 'nama'=>'Wakaf SMP NU',                                    'icon'=>'bx-school',        'data'=>['2025'=>13900000,'2026'=>29320000]],
    ['no'=>50, 'nama'=>'Wakaf MTS Putra Putri',                           'icon'=>'bx-school',        'data'=>['2025'=>13500000,'2026'=>28720000]],
    ['no'=>51, 'nama'=>'Wakaf SMK NU',                                    'icon'=>'bx-school',        'data'=>['2025'=>13900000,'2026'=>32220000]],
    ['no'=>52, 'nama'=>'Wakaf MWC NU Turi',                               'icon'=>'bx-group',         'data'=>['2025'=>10000000,'2026'=>10220000]],
    ['no'=>53, 'nama'=>'Wakaf PP Miftahul Huda',                          'icon'=>'bx-home-heart',    'data'=>['2025'=>10000000,'2026'=>10420000]],
    ['no'=>54, 'nama'=>'Wakaf MINU KH Mukmin',                            'icon'=>'bx-library',       'data'=>['2025'=>20000000,'2026'=>23420000]],
    ['no'=>55, 'nama'=>'Wakaf PP Dua Nganjuk',                            'icon'=>'bx-home-heart',    'data'=>['2025'=>30000000,'2026'=>32620000]],
    ['no'=>56, 'nama'=>'Wakaf Bani Qoffal',                               'icon'=>'bx-donate-heart',  'data'=>['2025'=>50000000,'2026'=>70820000]],
    ['no'=>57, 'nama'=>'Wakaf Bani Miraza',                               'icon'=>'bx-donate-heart',  'data'=>['2025'=>1000000,'2026'=>105420000]],
    ['no'=>58, 'nama'=>'Wakaf PPMA Asrama D',                             'icon'=>'bx-building-house','data'=>['2025'=>10000000,'2026'=>120020000]],
    ['no'=>59, 'nama'=>'Wakaf TPQ Nashoihuddin',                          'icon'=>'bx-book',          'data'=>['2025'=>10000000,'2026'=>11620000]],
    ['no'=>60, 'nama'=>'Wakaf PP Mahabbatul Quran',                       'icon'=>'bx-book-open',     'data'=>['2025'=>10000000,'2026'=>10520000]],
    ['no'=>61, 'nama'=>'Wakaf LP Nurul Hidayah',                          'icon'=>'bx-library',       'data'=>['2025'=>10000000,'2026'=>10320000]],
    ['no'=>62, 'nama'=>'Wakaf Cafe Gen Z',                                'icon'=>'bx-store',         'data'=>['2025'=>10000000,'2026'=>11340000]],
    ['no'=>63, 'nama'=>'Wakaf Yayasan Al Khoiriyah',                      'icon'=>'bx-donate-heart',  'data'=>['2025'=>10000000,'2026'=>10220000]],
    ['no'=>64, 'nama'=>'Wakaf Desa Gambuhan',                             'icon'=>'bx-home',          'data'=>['2025'=>10000000,'2026'=>10320000]],
    ['no'=>65, 'nama'=>'Wakaf YYS Miftahut Tholibin',                     'icon'=>'bx-donate-heart',  'data'=>['2025'=>10000000,'2026'=>10320000]],
    ['no'=>66, 'nama'=>'Wakaf YYS Azzahidiyah',                           'icon'=>'bx-donate-heart',  'data'=>['2025'=>10000000,'2026'=>10320000]],
    ['no'=>67, 'nama'=>'Wakaf PPMA Asrama F',                             'icon'=>'bx-building-house','data'=>['2025'=>10000000,'2026'=>11020000]],
    ['no'=>68, 'nama'=>'Wakaf PPHQ Jogoroto',                             'icon'=>'bx-home-heart',    'data'=>['2025'=>10000000,'2026'=>10220000]],
    ['no'=>69, 'nama'=>'Wakaf YP Baitussalam',                            'icon'=>'bx-donate-heart',  'data'=>['2026'=>10100000]],
    ['no'=>70, 'nama'=>'Wakaf PP Manbaul Quran',                          'icon'=>'bx-book-open',     'data'=>['2026'=>10000000]],
    ['no'=>71, 'nama'=>'Wakaf YYS Husnul Khotimah',                       'icon'=>'bx-donate-heart',  'data'=>['2026'=>10000000]],
    ['no'=>72, 'nama'=>'Wakaf YYS Al Fatih',                              'icon'=>'bx-donate-heart',  'data'=>['2026'=>10000000]],
    ['no'=>73, 'nama'=>'Wakaf PPRU Suramadu',                             'icon'=>'bx-home-heart',    'data'=>['2026'=>10000000]],
    ['no'=>74, 'nama'=>'Wakaf Desa Sukosari',                             'icon'=>'bx-home',          'data'=>['2026'=>10000000]],
    ['no'=>75, 'nama'=>'Wakaf BMT NU Ngasem',                             'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>76, 'nama'=>'Wakaf BMT Halaqoh',                               'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>77, 'nama'=>'Wakaf BMT NU Singgahan',                          'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>78, 'nama'=>'Wakaf Kopsyah Talun',                             'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>79, 'nama'=>'Wakaf Artha Mulya',                               'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>80, 'nama'=>'Wakaf BMT SC Barokah',                            'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>81, 'nama'=>'Wakaf KKS Bimantara',                             'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>82, 'nama'=>'Wakaf BMT NUT Temayang',                          'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>83, 'nama'=>'Wakaf YYS KH Asad Ismail',                        'icon'=>'bx-donate-heart',  'data'=>['2026'=>10000000]],
    ['no'=>84, 'nama'=>'Wakaf PP Darul Hikmah',                           'icon'=>'bx-home-heart',    'data'=>['2026'=>10000000]],
    ['no'=>85, 'nama'=>'Wakaf PPAI BU',                                   'icon'=>'bx-book',          'data'=>['2026'=>10000000]],
    ['no'=>86, 'nama'=>'Wakaf Yasmin Lamongan',                           'icon'=>'bx-donate-heart',  'data'=>['2026'=>10000000]],
    ['no'=>87, 'nama'=>'Wakaf BMT NYRU',                                  'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>88, 'nama'=>'Wakaf Madin Darul Ulum',                          'icon'=>'bx-book',          'data'=>['2026'=>10000000]],
    ['no'=>89, 'nama'=>'Wakaf MT Al Manshuri',                            'icon'=>'bx-buildings',     'data'=>['2026'=>10000000]],
    ['no'=>90, 'nama'=>'Wakaf Darush Sholihin',                           'icon'=>'bx-home-heart',    'data'=>['2026'=>10000000]],
    ['no'=>91, 'nama'=>'Wakaf KSPPS Berkah Manunggal Syariah',            'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>92, 'nama'=>'Wakaf Salafiyah',                                 'icon'=>'bx-home-heart',    'data'=>['2026'=>10000000]],
    ['no'=>93, 'nama'=>'Wakaf Bani Abd Alim',                             'icon'=>'bx-donate-heart',  'data'=>['2026'=>10000000]],
    ['no'=>94, 'nama'=>'Wakaf Agawe Makmur',                              'icon'=>'bx-bank',          'data'=>['2026'=>10000000]],
    ['no'=>95, 'nama'=>'Wakaf Alumni Mawar',                              'icon'=>'bx-group',         'data'=>['2026'=>10000000]],
];

$akun_json = json_encode($akun_list, JSON_UNESCAPED_UNICODE);
$jumlah    = count($akun_list);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perkembangan Wakaf Uang - MAAL KSPPS MAWAR</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        :root {
            --navy: #1a2d4f; --navy2: #243a63; --teal: #2a9d8f;
            --gold: #e9c46a; --light: #f4f7fb; --card-bg: #ffffff;
            --border: #dde4ef; --text: #2d3748; --muted: #718096;
        }
        #wakaf-detail-page * { box-sizing: border-box; margin: 0; padding: 0; }
        #wakaf-detail-page { font-family: 'Poppins', sans-serif; background: var(--light); color: var(--text); }

        /* ── Header ── */
        .site-header { background: var(--navy); padding: 14px 0; position: sticky; top: 0; z-index: 999; box-shadow: 0 2px 12px rgba(55, 81, 126, 0.2); }
        .site-header .inner { max-width: 1200px; margin: auto; padding: 0 24px; display: flex; align-items: center; justify-content: space-between; }
        .site-header .brand { font-family: 'Playfair Display', serif; color: #fff; font-size: 1.25rem; text-decoration: none; }
        .site-header .back-btn { color: var(--gold); text-decoration: none; font-size: .85rem; display: flex; align-items: center; gap: 6px; transition: opacity .2s; }
        .site-header .back-btn:hover { opacity: .75; }

        /* ── Hero ── */
        .page-hero { padding: 40px 24px 20px; text-align: center; }
        .page-hero h1 { font-family: 'Poppins', sans-serif; color: #37517e; font-size: 28px; font-weight: 600; text-transform: uppercase; margin-bottom: 5px; }
        .page-hero p { display: none; }

        /* ── Control bar ── */
        .control-bar { max-width: 1000px; margin: 24px auto 0; padding: 0 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
        .result-count { font-size: .85rem; color: var(--muted); }
        .result-count strong { color: var(--navy); }
        .result-count .src-badge { font-size: .75rem; padding: 2px 8px; border-radius: 10px; margin-left: 8px; font-weight: 500; }
        .src-live  { background: #d4edda; color: #155724; }
        .src-cache { background: #fff3cd; color: #856404; }
        .btn-global { display: flex; align-items: center; gap: 8px; padding: 9px 20px; border-radius: 8px; font-size: .85rem; font-weight: 600; cursor: pointer; border: 2px solid var(--navy); background: var(--navy); color: #fff; transition: all .2s; font-family: 'Poppins', sans-serif; }
        .btn-global:hover { background: transparent; color: var(--navy); }
        .btn-global.all-hidden { background: transparent; color: var(--navy); }
        .btn-global.all-hidden:hover { background: var(--navy); color: #fff; }
        .btn-back { display: flex; align-items: center; gap: 8px; padding: 9px 20px; border-radius: 8px; font-size: .85rem; font-weight: 600; cursor: pointer; border: 2px solid var(--navy); background: transparent; color: var(--navy); text-decoration: none; transition: all .2s; font-family: 'Poppins', sans-serif; }
        .btn-back:hover { background: var(--navy); color: #fff; text-decoration: none; }

        /* ── Search ── */
        .search-wrap { max-width: 1000px; margin: 14px auto 0; padding: 0 24px; }
        .search-box { width: 100%; padding: 10px 16px 10px 40px; border: 1.5px solid var(--border); border-radius: 10px; font-family: 'Poppins', sans-serif; font-size: .88rem; color: var(--text); background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23718096' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.099zm-5.242 1.156a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z'/%3E%3C/svg%3E") no-repeat 14px center; outline: none; transition: border-color .2s; }
        .search-box:focus { border-color: var(--navy); }

        /* ── Daftar akun — 1 per baris ── */
        .accounts-list { max-width: 1000px; margin: 16px auto 60px; padding: 0 24px; }
        .akun-row { background: var(--card-bg); border-radius: 14px; border: 1px solid var(--border); overflow: hidden; box-shadow: 0 2px 8px rgba(55, 81, 126, 0.2); margin-bottom: 12px; transition: box-shadow .25s; }
        .akun-row:hover { box-shadow: 0 8px 28px rgba(55, 81, 126, 0.2); }
        .akun-header { padding: 16px 20px; display: flex; align-items: center; gap: 14px; cursor: pointer; background: #fff; border-bottom: 1px solid transparent; transition: border-color .2s, background .15s; user-select: none; }
        .akun-row.open .akun-header { border-bottom-color: var(--border); background: #37517e; }
        .akun-header:hover { background: #f4f7fb; }
        .akun-icon { width: 44px; height: 44px; border-radius: 10px; background: linear-gradient(135deg, var(--navy), var(--navy2)); display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
        .akun-icon i { color: var(--gold); font-size: 1.25rem; }
        .akun-meta { flex: 1; min-width: 0; }
        .akun-name { font-weight: 600; font-size: .92rem; color: var(--navy); margin-bottom: 2px; }
        .akun-latest { font-size: .80rem; color: var(--muted); }
        .akun-latest span { color: var(--teal); font-weight: 600; }
        .akun-no { font-size: .78rem; color: #a0aec0; background: #f4f7fb; padding: 3px 10px; border-radius: 20px; flex-shrink: 0; }
        .toggle-icon { width: 30px; height: 30px; border-radius: 50%; background: var(--light); display: flex; align-items: center; justify-content: center; flex-shrink: 0; transition: background .2s; }
        .toggle-icon i { font-size: 1.15rem; color: var(--navy); transition: transform .3s; }
        .akun-row.open .toggle-icon { background: var(--navy); }
        .akun-row.open .toggle-icon i { color: #fff; transform: rotate(180deg); }

        /* ── Chart ── */
        .akun-body { max-height: 0; overflow: hidden; transition: max-height .45s cubic-bezier(.4,0,.2,1); }
        .akun-row.open .akun-body { max-height: 800px; }
        .chart-wrap { padding: 18px 22px 22px; height: 320px; }
        .chart-wrap canvas { width: 100% !important; height: 100% !important; }

        /* ── Monthly Styles ── */
        .monthly-wrap { padding-bottom: 22px; display: flex; flex-direction: column; }
        .monthly-divider { margin: 0 22px 16px; border-top: 1px dashed var(--border); }
        .year-buttons { display: flex; gap: 8px; flex-wrap: wrap; margin: 0 22px 16px; justify-content: center; }
        .btn-year { padding: 6px 14px; border: 1.5px solid var(--navy); border-radius: 8px; background: transparent; color: var(--navy); font-size: 0.8rem; font-weight: 500; cursor: pointer; transition: 0.2s; font-family: 'Poppins', sans-serif;}
        .btn-year:hover { background: #f4f7fb; }
        .btn-year.active { background: var(--navy); color: #fff; }
        .monthly-chart-wrap { height: 250px; margin: 0 22px; }

        /* ── Footer ── */
        .page-footer { background: var(--navy); color: rgba(55, 81, 126, 0.2); text-align: center; font-size: .8rem; padding: 24px; }
        .page-footer strong { color: var(--gold); }

        .no-result { text-align: center; padding: 40px 0; color: var(--muted); font-size: .9rem; display: none; }

        @media (max-width: 576px) { .page-hero { padding: 40px 16px 36px; } }
    </style>

</head>
<body>

<!-- ── Header ── -->
<header class="site-header">
    <div class="inner">
        <a href="/" class="brand">KSPPS MAWAR</a>
        <div style="display:flex;align-items:center;gap:12px;">
            <span id="live-indicator" style="font-size:.75rem;color:rgba(55, 81, 126, 0.2);display:none;">
                <i class='bx bx-loader-alt bx-spin' style="vertical-align:middle"></i> memuat data terbaru…
            </span>
            <a href="/" class="back-btn"><i class='bx bx-arrow-back'></i> Kembali ke Beranda</a>
        </div>
    </div>
</header>

<!-- ── Hero ── -->
<div class="page-hero">
    <!--<div class="hero-badge">UNIT MAAL</div>-->
    <h1>Perkembangan Wakaf Uang</h1>
    <p>Rincian perkembangan tiap akun Wakaf Uang yang dikelola KSPPS MAWAR Jatim dari tahun ke tahun</p>
</div>

<!-- ── Control bar ── -->
<div class="control-bar">
    <div class="result-count">
        Menampilkan <strong id="jumlah-akun"><?= $jumlah ?></strong> akun wakaf
        <span id="src-badge" class="src-badge src-cache" title="Data dari cache lokal, belum diperbarui dari Google Sheets">lembaga mitra</span>
    </div>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
        <button class="btn-global all-hidden" id="btn-toggle-all" onclick="toggleAll()">
            <i class='bx bx-show' id="ico-toggle"></i>
            <span id="txt-toggle">Tampilkan Semua Grafik</span>
        </button>
        <a class="btn-back" href="/"><i class='bx bx-arrow-back'></i> Kembali</a>
    </div>
</div>

<!-- ── Search box ── -->
<div class="search-wrap">
    <input type="text" class="search-box" id="search-box" placeholder="Cari nama akun atau nomor..." oninput="doSearch(this.value)">
</div>

<!-- ── Daftar akun ── -->
<div class="accounts-list" id="accounts-list">
    <div class="no-result" id="no-result">Tidak ada akun yang cocok dengan pencarian.</div>
</div>

<!-- ── Footer ── -->
<footer class="page-footer">
    &copy; 2021 &nbsp;|&nbsp; <strong>TIM IT MAWAR</strong> &nbsp;|&nbsp; KSPP Syariah Mawar Jatim
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.2/papaparse.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
// ══════════════════════════════════════════════════════════════
// DATA FALLBACK (dari PHP — selalu tersedia, halaman langsung tampil)
// ══════════════════════════════════════════════════════════════
var AKUN_DATA = <?= $akun_json ?>;

// Google Apps Script endpoint — URL BARU
var GAS_URL = 'https://script.google.com/macros/s/AKfycbzidQ2JFQuA3KkBIerHr5TUilAzHCo5i-zgT2jfzjZ6IBq1PcC7XvRTdZQY9u15eEfj/exec';

var chartInstances = {};
var allOpen = false;
var liveLoaded = false;

// Monthly Data Variables
var MONTHLY_DATA = {}; 
var monthlyChartInstances = {};
var monthlyDataLoaded = false;
var CSV_GIDS = {
    '2023': '0',
    '2024': '639020996',
    '2025': '103473954',
    '2026': '162336325'
};
var CSV_BASE_URL = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vTXCXyDsiDIWVKVEHSd5dzljx7PVvddCFONA_WOFi9eVYNHuG-_StdExptnzDHsIbFfcAujkgAfUklY/pub?output=csv&gid=';

function fetchAllMonthlyData() {
    var promises = Object.keys(CSV_GIDS).map(function(year) {
        return fetch(CSV_BASE_URL + CSV_GIDS[year])
            .then(function(res) { return res.text(); })
            .then(function(text) { parseMonthlyCSV(text, year); });
    });
    Promise.all(promises).then(function() {
        monthlyDataLoaded = true;
        var openRows = document.querySelectorAll('.akun-row.open');
        openRows.forEach(function(r) {
            var idx = r.id.replace('row-', '');
            renderMonthlySection(idx);
        });
    }).catch(function(e) {
        console.warn("Gagal memuat data bulanan", e);
        monthlyDataLoaded = true; 
    });
}

function parseMonthlyCSV(csvText, year) {
    var lines = csvText.split('\n');
    var headerRowIdx = -1;
    for(var i=0; i<lines.length; i++) {
        if(lines[i].includes('NO') && lines[i].includes('NAMA LEMBAGA')) {
            headerRowIdx = i;
            break;
        }
    }
    if(headerRowIdx === -1) return;
    
    var result = Papa.parse(lines.slice(headerRowIdx).join('\n'), { header: true, skipEmptyLines: true });
    
    result.data.forEach(function(row) {
        var noStr = row['NO'] || '';
        var no = parseInt(noStr.trim());
        if(isNaN(no)) return;
        
        if(!MONTHLY_DATA[no]) MONTHLY_DATA[no] = {};
        
        var months = ['JAN','FEB','MAR','APR','MEI','JUN','JUL','AGT','SEP','OKT','NOV','DES'];
        var hasData = false;
        var mData = {};
        months.forEach(function(m) {
            var val = parseRpString(row[m]);
            mData[m] = val;
            if(val > 0) hasData = true;
        });
        
        if(hasData) {
            MONTHLY_DATA[no][year] = mData;
        }
    });
}

function parseRpString(val) {
    if(!val) return 0;
    var clean = String(val).replace(/[^\d]/g, '');
    return parseInt(clean, 10) || 0;
}

// ── Format Rupiah ──────────────────────────────────────────────
function formatRp(val) {
    val = parseFloat(val) || 0;
    if (val >= 1e9) return 'Rp\u00a0' + (val/1e9).toFixed(2).replace('.',',') + '\u00a0M';
    if (val >= 1e6) return 'Rp\u00a0' + (val/1e6).toFixed(1).replace('.',',') + '\u00a0Jt';
    return 'Rp\u00a0' + val.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
function formatRpFull(val) {
    return 'Rp ' + parseFloat(val).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

// ── Bangun daftar akun ────────────────────────────────────────
function buildList(data) {
    var list = document.getElementById('accounts-list');
    // Hapus semua baris akun, sisakan elemen no-result
    var rows = list.querySelectorAll('.akun-row');
    rows.forEach(function(r){ r.remove(); });
    chartInstances = {};
    monthlyChartInstances = {};
    allOpen = false;
    updateToggleAllBtn();

    data.forEach(function(akun, idx) {
        var years    = Object.keys(akun.data).filter(function(y){ return akun.data[y] && !isNaN(parseFloat(akun.data[y])); });
        if (years.length === 0) return;
        var latestY  = years[years.length - 1];
        var latestV  = akun.data[latestY];
        var icon     = akun.icon || 'bx-dollar-circle';
        var no       = akun.no || (idx + 1);

        var row = document.createElement('div');
        row.className = 'akun-row';
        row.id = 'row-' + idx;
        row.dataset.name = (akun.nama || '').toLowerCase();
        row.dataset.no   = String(no);
        row.innerHTML =
            '<div class="akun-header" onclick="toggleRow(' + idx + ')">' +
                '<div class="akun-icon"><i class="bx ' + icon + '"></i></div>' +
                '<div class="akun-meta">' +
                    '<div class="akun-name">' + (akun.nama || 'Akun ' + no) + '</div>' +
                    '<div class="akun-latest">Per ' + latestY + ': <span>' + formatRp(latestV) + '</span></div>' +
                '</div>' +
                '<span class="akun-no">No.\u00a0' + no + '</span>' +
                '<div class="toggle-icon"><i class="bx bx-chevron-down"></i></div>' +
            '</div>' +
            '<div class="akun-body" id="body-' + idx + '">' +
                '<div class="chart-wrap"><canvas id="chart-' + idx + '"></canvas></div>' +
                '<div class="monthly-wrap" id="monthly-wrap-' + idx + '"></div>' +
            '</div>';
        list.appendChild(row);
    });

    document.getElementById('jumlah-akun').textContent = data.length;
}

// ── Render grafik ─────────────────────────────────────────────
function renderChart(idx) {
    if (chartInstances[idx]) return;
    var akun   = AKUN_DATA[idx];
    var years  = Object.keys(akun.data).filter(function(y){ return akun.data[y] !== '' && !isNaN(parseFloat(akun.data[y])); });
    var values = years.map(function(y) { return parseFloat(akun.data[y]); });
    var canvas = document.getElementById('chart-' + idx);
    if (!canvas) return;
    var ctx = canvas.getContext('2d');
    chartInstances[idx] = new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [{
                label: akun.nama, data: values,
                backgroundColor: 'rgba(55, 81, 126, 0.2)',
                borderColor: '#1a2d4f', borderWidth: 2.5,
                pointBackgroundColor: '#e9c46a', pointBorderColor: '#1a2d4f',
                pointRadius: 5, pointHoverRadius: 7, fill: true
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            legend: { display: false },
            tooltips: { callbacks: { label: function(item) { return formatRpFull(item.yLabel); } } },
            scales: {
                xAxes: [{ gridLines: { display: false } }],
                yAxes: [{ ticks: { beginAtZero: true, callback: function(v) { return formatRp(v); } }, gridLines: { color: 'rgba(0,0,0,0.05)' } }]
            }
        }
    });
}

// ── Toggle baris ──────────────────────────────────────────────
function toggleRow(idx) {
    var row = document.getElementById('row-' + idx);
    if (!row) return;
    if (row.classList.contains('open')) {
        row.classList.remove('open');
    } else {
        row.classList.add('open');
        setTimeout(function() { 
            renderChart(idx); 
            renderMonthlySection(idx);
        }, 50);
    }
    updateToggleAllBtn();
}

// ── Toggle semua ──────────────────────────────────────────────
function toggleAll() {
    allOpen = !allOpen;
    AKUN_DATA.forEach(function(_, idx) {
        var row = document.getElementById('row-' + idx);
        if (!row || row.style.display === 'none') return;
        if (allOpen) {
            row.classList.add('open');
            setTimeout(function() { 
                renderChart(idx); 
                renderMonthlySection(idx);
            }, 50 + idx * 15);
        } else {
            row.classList.remove('open');
        }
    });
    updateToggleAllBtn();
}

function updateToggleAllBtn() {
    var visibleRows = document.querySelectorAll('.akun-row:not([style*="none"])');
    var openCount   = document.querySelectorAll('.akun-row.open').length;
    var btn = document.getElementById('btn-toggle-all');
    var ico = document.getElementById('ico-toggle');
    var txt = document.getElementById('txt-toggle');
    if (openCount > 0 && openCount >= visibleRows.length) {
        allOpen = true;
        ico.className = 'bx bx-hide';
        txt.textContent = 'Sembunyikan Semua Grafik';
        btn.classList.remove('all-hidden');
    } else {
        allOpen = false;
        ico.className = 'bx bx-show';
        txt.textContent = 'Tampilkan Semua Grafik';
        btn.classList.add('all-hidden');
    }
}

// ── Render Grafik Bulanan ─────────────────────────────────────
function renderMonthlySection(idx) {
    var wrap = document.getElementById('monthly-wrap-' + idx);
    var akun = AKUN_DATA[idx];
    var no = akun.no;
    
    if(!monthlyDataLoaded) {
        wrap.innerHTML = '<div style="text-align:center;font-size:0.8rem;color:#718096;padding:10px;"><i class="bx bx-loader-alt bx-spin"></i> Memuat data bulanan...</div>';
        return;
    }
    
    if(!MONTHLY_DATA[no]) {
        wrap.innerHTML = '<div style="text-align:center;font-size:0.8rem;color:#718096;padding:10px;">Data bulanan tidak tersedia.</div>';
        return;
    }
    
    var availableYears = Object.keys(MONTHLY_DATA[no]).sort();
    if(availableYears.length === 0) {
        wrap.innerHTML = '<div style="text-align:center;font-size:0.8rem;color:#718096;padding:10px;">Data bulanan kosong.</div>';
        return;
    }
    
    if(wrap.querySelector('.year-buttons')) return;
    
    var html = '<div class="monthly-divider"></div>';
    html += '<div style="text-align:center;font-size:0.85rem;margin-bottom:12px;font-weight:600;color:var(--navy);">Detail Perkembangan Bulanan</div>';
    html += '<div class="year-buttons">';
    availableYears.forEach(function(year) {
        html += '<button class="btn-year" onclick="showMonthlyChart(' + idx + ', \'' + year + '\', this)">' + year + '</button>';
    });
    html += '</div>';
    html += '<div class="monthly-chart-wrap"><canvas id="mchart-' + idx + '"></canvas></div>';
    
    wrap.innerHTML = html;
    
    var latestBtn = wrap.querySelectorAll('.btn-year')[availableYears.length - 1];
    if(latestBtn) latestBtn.click();
}

function showMonthlyChart(idx, year, btnElem) {
    var wrap = document.getElementById('monthly-wrap-' + idx);
    var btns = wrap.querySelectorAll('.btn-year');
    btns.forEach(function(b) { b.classList.remove('active'); });
    btnElem.classList.add('active');
    
    var akun = AKUN_DATA[idx];
    var no = akun.no;
    var data = MONTHLY_DATA[no][year];
    
    var months = ['JAN','FEB','MAR','APR','MEI','JUN','JUL','AGT','SEP','OKT','NOV','DES'];
    var values = months.map(function(m) { return data[m] || 0; });
    
    var canvasId = 'mchart-' + idx;
    var canvas = document.getElementById(canvasId);
    if (!canvas) return;
    
    if(monthlyChartInstances[idx]) {
        monthlyChartInstances[idx].destroy();
    }
    
    var ctx = canvas.getContext('2d');
    monthlyChartInstances[idx] = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Wakaf ' + year,
                data: values,
                backgroundColor: 'rgba(42, 157, 143, 0.15)',
                borderColor: '#2a9d8f', borderWidth: 2.5,
                pointBackgroundColor: '#e9c46a', pointBorderColor: '#2a9d8f',
                pointRadius: 5, pointHoverRadius: 7, fill: true
            }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            legend: { display: false },
            tooltips: { callbacks: { label: function(item) { return formatRpFull(item.yLabel); } } },
            scales: {
                xAxes: [{ gridLines: { display: false } }],
                yAxes: [{ 
                    ticks: { 
                        beginAtZero: true, 
                        callback: function(v) { return formatRp(v); },
                        maxTicksLimit: 6
                    }, 
                    gridLines: { color: 'rgba(0,0,0,0.05)', drawBorder: false } 
                }]
            }
        }
    });
}

// ── Pencarian ─────────────────────────────────────────────────
function doSearch(q) {
    q = q.toLowerCase().trim();
    var rows = document.querySelectorAll('.akun-row');
    var visible = 0;
    rows.forEach(function(row) {
        var name = row.dataset.name || '';
        var no   = row.dataset.no   || '';
        var match = q === '' || name.includes(q) || no.includes(q);
        row.style.display = match ? '' : 'none';
        if (match) visible++;
    });
    document.getElementById('jumlah-akun').textContent = visible;
    document.getElementById('no-result').style.display = (visible === 0) ? 'block' : 'none';
}

// ══════════════════════════════════════════════════════════════
// NORMALISASI — ubah format JSON dari GAS ke format internal
// GAS mengirim: {NO, "REKENING (AKUN)", "2020", "2021", ...}
// Internal butuh: {no, nama, icon, data:{tahun: nilai}}
// ══════════════════════════════════════════════════════════════
function normalizeGAS(json) {
    var YEARS = ['2020','2021','2022','2023','2024','2025','2026','2027'];
    var ICONS = [
        'bx-home-heart','bx-building-house','bx-building-house','bx-droplet','bx-recycle',
        'bx-gas-pump','bx-home','bx-store','bx-book-open','bx-group',
        'bx-donate-heart','bx-user','bx-library','bx-church','bx-graduation',
        'bx-trip','bx-buildings','bx-buildings','bx-book','bx-building-house'
    ];
    return json.map(function(item) {
        var no   = item['NO']   || item['no']   || 0;
        var nama = item['REKENING (AKUN)'] || item['nama'] || item['NAMA'] || ('Akun ' + no);
        // Ambil data tahun
        var data = {};
        YEARS.forEach(function(y) {
            var v = item[y];
            if (v !== '' && v !== null && v !== undefined && !isNaN(parseFloat(v))) {
                data[y] = parseFloat(v);
            }
        });
        // Jika tidak ada data tahun sama sekali, skip
        if (Object.keys(data).length === 0) return null;

        // Ambil icon dari fallback data jika ada (berdasarkan no), atau default
        var fallback = AKUN_DATA.find(function(a){ return a.no == no; });
        var icon = (fallback && fallback.icon) ? fallback.icon : (ICONS[(no - 1) % ICONS.length] || 'bx-dollar-circle');

        return { no: Number(no), nama: String(nama), icon: icon, data: data };
    }).filter(function(a){ return a !== null && a.nama; });
}

// ══════════════════════════════════════════════════════════════
// FETCH LIVE — dari Google Apps Script
// Dipanggil setelah halaman tampil, tidak memblokir render awal
// ══════════════════════════════════════════════════════════════
function fetchLiveData() {
    var indicator = document.getElementById('live-indicator');
    var badge     = document.getElementById('src-badge');
    indicator.style.display = 'inline';

    var done  = false;
    var timer = setTimeout(function() {
        if (!done) { done = true; indicator.style.display = 'none'; }
    }, 12000);

    fetch(GAS_URL)
        .then(function(res) {
            if (!res.ok) throw new Error('HTTP ' + res.status);
            return res.json();
        })
        .then(function(json) {
            if (done) return; done = true;
            clearTimeout(timer);
            indicator.style.display = 'none';

            if (!Array.isArray(json) || json.length === 0) throw new Error('Format tidak dikenali');

            var normalized = normalizeGAS(json);
            if (normalized.length === 0) throw new Error('Data kosong setelah normalisasi');

            // Update global & rebuild UI
            AKUN_DATA = normalized;
            buildList(AKUN_DATA);

            // Terapkan ulang pencarian jika sedang aktif
            var q = document.getElementById('search-box').value;
            if (q) doSearch(q);

            badge.className = 'src-badge src-live';
            badge.textContent = 'live';
            badge.title = 'Data langsung dari Google Sheets (' + normalized.length + ' akun)';
            liveLoaded = true;
        })
        .catch(function(err) {
            if (!done) { done = true; clearTimeout(timer); }
            indicator.style.display = 'none';
            console.warn('GAS fetch gagal, menggunakan data cadangan:', err.message);
            // Badge tetap "cadangan", data PHP tetap digunakan
        });
}

// ══════════════════════════════════════════════════════════════
// INIT
// ══════════════════════════════════════════════════════════════
buildList(AKUN_DATA);
fetchLiveData();
fetchAllMonthlyData();
</script>
</body>
</html>