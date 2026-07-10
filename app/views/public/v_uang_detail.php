<?php
$GLOBALS['akun_json_data'] = $akun_json_data = null;
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
    ['no'=>96, 'nama'=>'Wakaf MDT Darul Hikmah',                          'icon'=>'bx-library',       'data'=>['2026'=>10000000]],
    ['no'=>97, 'nama'=>'Wakaf MT KH Rais',                                'icon'=>'bx-buildings',     'data'=>['2026'=>10000000]],
];

// ── Data VA Bank Lain (selain BSI) per nomor akun ──────────────
$va_data = [
     1=>'9002677002001002286',  2=>'9002677002001001690',  3=>'9002677002001006510',
     4=>'9002677002001009268',  5=>'9002677002001009270',  6=>'9002677002001009272',
     7=>'9002677002001009274',  8=>'9002677002001006190',  9=>'9002677002001002285',
    10=>'9002677002001009277', 11=>'9002677002001006287', 12=>'9002677002001007020',
    13=>'9002677002001006938', 14=>'9002677002001007026', 15=>'9002677002001007778',
    16=>'9002677002001009266', 17=>'9002677002003000642', 18=>'9002677002003000640',
    19=>'9002677002003000644', 20=>'9002677002001007074', 21=>'9002677002005000553',
    22=>'9002677002002000126', 23=>'9002677002001009115', 24=>'9002677002002000057',
    25=>'9002677002003000580', 26=>'9002677002004000259', 27=>'9002677002005000552',
    28=>'9002677002005000581', 29=>'9002677002001007784', 30=>'9002677002001010275',
    31=>'9002677002004000684', 32=>'9002677002003000800', 33=>'9002677002003000802',
    34=>'9002677002004000706', 35=>'9002677002001010370', 36=>'9002677002001007266',
    37=>'9002677002001010625', 38=>'9002677002001010626', 39=>'9002677002003000899',
    40=>'9002677002004000781', 41=>'9002677002001010743', 42=>'9002677002001010745',
    43=>'9002677002001010747', 44=>'9002677002001010835', 45=>'9002677002001011145',
    46=>'9002677002001011156', 47=>'9002677002001011172', 48=>'9002677002001011373',
    49=>'9002677002001007268', 50=>'9002677002001007267', 51=>'9002677002001007269',
    52=>'9002677002005001214', 53=>'9002677002001011393', 54=>'9002677002001011423',
    55=>'9002677002001012272', 56=>'9002677002001012573', 57=>'9002677002001012834',
    58=>'9002677002001012912', 59=>'9002677002001012972', 60=>'9002677002001012987',
    61=>'9002677002001012997', 62=>'9002677002001011419', 63=>'9002677002001012999',
    64=>'9002677002001013005', 65=>'9002677002001013007', 66=>'9002677002001013014',
    67=>'9002677002001013018', 68=>'9002677002001013090', 69=>'9002677002001013112',
    70=>'9002677002001013136', 71=>'9002677002001013150', 72=>'9002677002001013155',
    73=>'9002677002001013204', 74=>'9002677002001013220', 75=>'9002677002001013220',
    76=>'9002677002001013220', 77=>'9002677002001013220', 78=>'9002677002001013220',
    79=>'9002677002001013220', 80=>'9002677002001013220', 81=>'9002677002001013220',
    82=>'9002677002001013220', 83=>'9002677002001013256', 84=>'9002677002001013261',
    85=>'9002677002001013264', 86=>'9002677002001013267', 87=>'9002677002001013274',
    88=>'9002677002001013277', 89=>'9002677002001013280', 90=>'9002677002001013285',
    91=>'9002677002001013288', 92=>'9002677002001013292', 93=>'9002677002001013298',
    94=>'9002677002001013306', 95=>'9002677002001013310', 96=>'9002677002001013326',
    97=>'9002677002001013331',
];
// Merge VA ke setiap akun
foreach ($akun_list as &$akun) {
    $va_lain = $va_data[$akun['no']] ?? '';
    $akun['va_lain'] = $va_lain;
    $akun['va_bsi']  = $va_lain ? substr($va_lain, 7) : '';
}
unset($akun);

$GLOBALS["akun_json_data"] = json_encode($akun_list, JSON_UNESCAPED_UNICODE);
$jumlah    = count($akun_list);
?>

<style>
        :root {
            --navy: #1a2d4f; --navy2: #243a63; --teal: #2a9d8f;
            --gold: #e9c46a; --light: #f4f7fb; --card-bg: #ffffff;
            --border: #dde4ef; --text: #2d3748; --muted: #718096;
        }
        /* ── VA Bank Lain & VA BSI ── */
        .va-bar-container { padding: 12px 20px 14px; background: #f8faff; border-top: 1px solid var(--border); display: flex; flex-direction: column; gap: 10px; }
        .va-bar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; }
        .va-label { font-size: .8rem; font-weight: 600; color: var(--navy); display: flex; align-items: center; gap: 6px; }
        .va-label i { font-size: 1.1rem; }
        .va-action { display: flex; align-items: center; gap: 10px; }
        .va-number { font-size: .95rem; font-weight: 700; color: var(--navy); font-family: 'Courier New', monospace; letter-spacing: 1px; }
        .btn-copy { display: inline-flex; align-items: center; gap: 4px; padding: 4px 12px; border-radius: 4px; border: 1px solid var(--teal); background: transparent; color: var(--teal); font-size: .75rem; font-weight: 600; cursor: pointer; transition: all .2s; font-family: 'Poppins', sans-serif; }
        .btn-copy:hover { background: var(--teal); color: #fff; }
        .btn-copy.copied { background: #28a745; border-color: #28a745; color: #fff; }
        #wakaf-detail-page * { box-sizing: border-box; }
        #wakaf-detail-page { font-family: 'Poppins', sans-serif; background: var(--light); color: var(--text); }

        /* ── Header ── */
        .site-header { background: var(--navy); padding: 14px 0; position: sticky; top: 0; z-index: 999; box-shadow: 0 2px 12px rgba(55, 81, 126, 0.2); }
        .site-header .inner { margin: auto; padding: 0 24px; display: flex; align-items: center; justify-content: space-between; }
        .site-header .brand { font-family: 'Playfair Display', serif; color: #fff; font-size: 1.25rem; text-decoration: none; }
        .site-header .back-btn { color: var(--gold); text-decoration: none; font-size: .85rem; display: flex; align-items: center; gap: 6px; transition: opacity .2s; }
        .site-header .back-btn:hover { opacity: .75; }

        /* ── Control bar ── */
        .control-bar { margin: 24px 0 20px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; }
        .result-count { font-size: .85rem; color: var(--muted); }
        .result-count strong { color: var(--navy); }
        .result-count .src-badge { font-size: .75rem; padding: 2px 8px; border-radius: 10px; margin-left: 8px; font-weight: 500; }
        .src-live  { background: #d4edda; color: #155724; }
        .src-cache { background: #fff3cd; color: #856404; }
        .btn-global { display: flex; align-items: center; gap: 8px; padding: 9px 20px; border-radius: 8px; font-size: .85rem; font-weight: 600; cursor: pointer; border: 2px solid var(--teal); background: var(--teal); color: #fff; transition: all .2s; font-family: 'Poppins', sans-serif; }
        .btn-global:hover { background: transparent; color: var(--teal); }
        .btn-global.all-hidden { background: transparent; border-color: var(--navy); color: var(--navy); }
        .btn-global.all-hidden:hover { background: var(--navy); color: #fff; }
        .btn-back { display: flex; align-items: center; gap: 8px; padding: 9px 20px; border-radius: 8px; font-size: .85rem; font-weight: 600; cursor: pointer; border: 2px solid var(--navy); background: transparent; color: var(--navy); text-decoration: none; transition: all .2s; font-family: 'Poppins', sans-serif; }
        .btn-back:hover { background: var(--navy); color: #fff; text-decoration: none; }

        /* ── Search ── */
        .search-wrap { margin: 14px 0 0; }
        .search-box { width: 100%; padding: 10px 16px 10px 40px; border: 1.5px solid var(--border); border-radius: 10px; font-family: 'Poppins', sans-serif; font-size: .88rem; color: var(--text); background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23718096' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.099zm-5.242 1.156a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z'/%3E%3C/svg%3E") no-repeat 14px center; outline: none; transition: border-color .2s; }
        .search-box:focus { border-color: var(--navy); }

        /* ── Daftar akun — 1 per baris ── */
        .accounts-list { margin: 16px 0 60px; }
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

        @media (max-width: 576px) {
            .control-btns { justify-content: center; width: 100%; }
            .control-btns button, .control-btns a { flex: 1; justify-content: center; text-align: center; }
            .result-count { text-align: center; width: 100%; margin-bottom: 8px; }
            .va-bar { flex-direction: column; align-items: flex-start; gap: 6px; padding-bottom: 8px; border-bottom: 1px dashed var(--border); }
            .va-bar:last-child { padding-bottom: 0; border-bottom: none; }
            .va-action { width: 100%; justify-content: space-between; }
        }
    </style>

<div class="container" id="wakaf-detail-page" style="margin-top: 100px;">
    <h4 class="text-center mb-2" style="color:#37517e; font-weight:bold;">DETAIL PERKEMBANGAN WAKAF UANG</h4>
    <div class="row">
        <div class="col-md-12">
            <!-- ── Control bar ── -->
            <div class="control-bar">
                <div class="result-count">
                    Menampilkan <strong id="jumlah-akun"><?= $jumlah ?></strong> akun wakaf
                    <span id="src-badge" class="src-badge src-cache" title="Data dari cache lokal, belum diperbarui dari Google Sheets">lembaga mitra</span>
                </div>
                <div class="control-btns" style="display:flex;gap:10px;flex-wrap:wrap;">
                    <button class="btn-global all-hidden" id="btn-toggle-all" onclick="toggleAll()">
                        <i class='bx bx-show' id="ico-toggle"></i>
                        <span id="txt-toggle">Tampilkan Semua Grafik</span>
                    </button>
                    <button id="btn-sync-all" onclick="syncAllData()" style="display:flex; align-items:center; gap:8px; padding:9px 20px; border-radius:8px; font-size:.85rem; font-weight:600; cursor:pointer; border:2px solid #e9c46a; background:#e9c46a; color:#1a2d4f; transition:all .2s; font-family:'Poppins',sans-serif;">
                        <i class='bx bx-sync'></i> Sinkronisasi Data Manual
                    </button>
                    <a href="https://laporan.maal.ppmawar.or.id" target="_blank" style="display:flex; align-items:center; gap:8px; padding:9px 20px; border-radius:8px; font-size:.85rem; font-weight:600; cursor:pointer; border:2px solid #2a9d8f; background:#2a9d8f; color:#fff; transition:all .2s; font-family:'Poppins',sans-serif; text-decoration:none;">
                        <i class='bx bx-file-find'></i> Laporan per Lembaga
                    </a>
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
        </div>
    </div>
</div>
