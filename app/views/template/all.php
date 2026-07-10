<?php require_once __DIR__ . '/../../helpers/gdrive_rat.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>MAAL KSPPS MAWAR</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?= BASEURL; ?>/public/arsha/img/logo.png" rel="icon">
    <link href="<?= BASEURL; ?>/public/arsha/img/logo.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= BASEURL; ?>/public/arsha/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/public/arsha/vendor/icofont/icofont.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/public/arsha/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/public/arsha/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/public/arsha/vendor/venobox/venobox.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/public/arsha/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= BASEURL; ?>/public/arsha/vendor/aos/aos.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= BASEURL; ?>/public/arsha/css/style.css" rel="stylesheet">
    <style>
        canvas { min-height: 250px !important; width: 100% !important; }

        /* ── Tombol Unit Tamwil ── */
        .nav-menu li.btn-tamwil { margin-left: 3px; }
        .nav-menu li.btn-tamwil a {
            display: inline-flex !important;
            align-items: center;
            gap: 5px;
            background: transparent;
            color: #c8daf4 !important;
            border: 1.5px solid #c8daf4;
            border-radius: 50px;
            padding: 5px 16px !important;
            font-size: 0.82rem;
            font-weight: 600;
            white-space: nowrap;
            transition: all .25s ease;
        }
        .nav-menu li.btn-tamwil a:hover {
            background: #c8daf4 !important;
            color: #37517e !important;
        }
        /* Mobile sidebar: full width */
        .mobile-nav li.btn-tamwil { margin: 8px 15px 0; }
        .mobile-nav li.btn-tamwil a {
            display: block !important;
            text-align: center;
            border: 2px solid #37517e;
            border-radius: 50px;
            color: #37517e !important;
            font-weight: 700;
            padding: 9px !important;
            background: rgba(55,81,126,0.06);
        }
        .mobile-nav li.btn-tamwil a:hover {
            background: #37517e !important;
            color: #ffffff !important;
        }
    </style>
</head>
<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">
        <h1 class="logo mr-auto"><a href="<?= BASEURL ?>">KSPPS MAWAR</a></h1>
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="<?= BASEURL ?>">Home</a></li>
                <li><a href="#services">Perkembangan</a></li>
                <li class="drop-down"><a href="#">Wakaf</a>
                    <ul>
                        <li><a href="<?= BASEURL; ?>/page/wakaf_uang">Wakaf Uang</a></li>
                        <li><a href="<?= BASEURL; ?>/page/wakaf_asset">Wakaf Asset</a></li>
                        <li><a href="<?= BASEURL; ?>/page/wakaf_polis">Wakaf Polis</a></li>
                        <li><a href="<?= BASEURL; ?>/page/wakaf_basmalah">Wakaf Toko Basmalah</a></li>
                    </ul>
                </li>
                <li class="drop-down"><a href="#">Laporan WAKAF</a>
                    <ul>
                        <li><a download href="<?= BASEURL; ?>/public/file/Laporan WU KOPMA 2023.pdf">Laporan WU KOPMA 2023</a></li>
                        <li><a download href="<?= BASEURL; ?>/public/file/Laporan WU KOPMA 2024.pdf">Laporan WU KOPMA 2024</a></li>
                        <li><a download href="<?= BASEURL; ?>/public/file/Laporan WU KOPMA-FM 2023.pdf">Laporan WU KOPMA-FM 2023</a></li>
                        <li><a download href="<?= BASEURL; ?>/public/file/1 Windu WU Kopma 2017-2024.pdf">Satu Windu WU Kopma 2017-2024</a></li>
                    </ul>
                </li>
                <li class="drop-down"><a href="#">Laporan RAT</a>
                    <ul>
                        <?php
                        $ratFiles = getGDriveLaporanRAT();
                        if (!empty($ratFiles)):
                            foreach ($ratFiles as $f):
                        ?>
                        <li>
                            <a href="<?= htmlspecialchars($f['url']) ?>" target="_blank">
                                <?= htmlspecialchars($f['name']) ?>
                            </a>
                        </li>
                        <?php endforeach; else: ?>
                        <li><a href="#">2020</a></li>
                        <li><a download href="<?= BASEURL; ?>/public/LPJ RAT 2021.pdf">2021</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
                <!-- Tombol Unit Tamwil (masuk sidebar mobile otomatis) -->
                <li class="btn-tamwil">
                    <a href="https://kopma.ppmawar.or.id/" target="_blank">
                        <i class="bx bx-buildings"></i> Unit Tamwil
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                <h1>Memelihara Amanah</h1>
                <h1>Meraih Berkah</h1>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                <img src="<?= BASEURL; ?>/public/arsha/img/logo.png" class="mx-auto d-block img-fluid animated" alt="" style="width: 60%;">
            </div>
        </div>
    </div>
</section><!-- End Hero -->

<main id="main">
    <!-- ======= Services Section ======= -->
    <section id="services" class="services section-bg">
        <div class="container" data-aos="fade-up">
            <div class="section-title">
                <h2>WAKAF</h2>
                <p>Berikut ini merupakan perkembangan Unit Maal (Wakaf) KSPPS MAWAR</p>
            </div>

            <!-- Grafik Ringkas (ditampilkan langsung) -->
            <div class="container-fluid" style="margin-bottom: 30px;">
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <canvas id="uang"></canvas>
                    </div>
                    <div class="col-md-4 mb-4">
                        <canvas id="grafik_hasil"></canvas>
                    </div>
                    <div class="col-md-4 mb-4">
                        <canvas id="grafik_penyaluran"></canvas>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-4">
                        <canvas id="basmalah"></canvas>
                    </div>
                </div>
            </div>

            <!-- Kartu Layanan -->
            <div class="container mt-2">
                <div class="row">
                    <!-- Wakaf Uang -->
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box w-100" style="cursor:pointer;" onclick="window.location.href='<?= BASEURL; ?>/page/wakaf_uang'">
                            <div class="icon"><i class="bx bx-dollar-circle"></i></div>
                            <h4><a href="<?= BASEURL; ?>/page/wakaf_uang" onclick="event.stopPropagation();">Wakaf Uang</a></h4>
                            <p>Wakaf Uang adalah wakaf berupa uang dalam bentuk rupiah yang kemudian dikelola oleh nazhir secara produktif, hasilnya dimanfaatkan untuk mauquf 'alaih.</p>
                            <div class="mt-3 text-center">
                                <a href="<?= BASEURL; ?>/page/wakaf_uang_detail" class="btn btn-primary" onclick="event.stopPropagation();">Lihat Grafik Detail</a>
                            </div>
                        </div>
                    </div>
                    <!-- Wakaf Asset -->
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box w-100" style="cursor:pointer;" onclick="window.location.href='<?= BASEURL; ?>/page/wakaf_asset'">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="<?= BASEURL; ?>/page/wakaf_asset" onclick="event.stopPropagation();">Wakaf Asset</a></h4>
                            <p>Wakaf Aset adalah aset wakaf berupa benda tidak bergerak dan benda bergerak selain uang yang ditujukan untuk kemaslahatan PP Matholi'ul Anwar (YPMA) Simo Sungelebak Karanggeneng Lamongan</p>
                        </div>
                    </div>
                    <!-- Wakaf Polis -->
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box w-100" style="cursor:pointer;" onclick="window.location.href='<?= BASEURL; ?>/page/wakaf_polis'">
                            <div class="icon"><i class="bx bx-user-pin"></i></div>
                            <h4><a href="<?= BASEURL; ?>/page/wakaf_polis" onclick="event.stopPropagation();">Wakaf Polis</a></h4>
                            <p>Wakaf Polis adalah wakaf berupa polis asuransi syariah yang mana nilai investasinya dan atau manfaat asuransinya diwakafkan untuk kemaslahatan PP. Matholi'ul Anwar (YPMA) Simo Sungelebak Karanggeneng Lamongan</p>
                        </div>
                    </div>
                    <!-- Wakaf Toko Basmalah -->
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                        <div class="icon-box w-100" style="cursor:pointer;" onclick="window.location.href='<?= BASEURL; ?>/page/wakaf_basmalah'">
                            <div class="icon"><i class="bx bx-buildings"></i></div>
                            <h4><a href="<?= BASEURL; ?>/page/wakaf_basmalah" onclick="event.stopPropagation();">Wakaf Toko Basmalah</a></h4>
                            <p>Wakaf Toko Basmalah adalah wakaf Simpanan Anggota Syirkah Toko Basmalah Cabang Simo Lamongan (S1001) untuk kemaslahatan PP. Matholi'ul Anwar (YPMA) Simo Sungelebak Karanggeneng Lamongan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Services Section -->
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row"></div>
        </div>
    </div>
    <div class="container footer-bottom clearfix">
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                    <p class="mb-2">KSPP SYARIAH MAWAR JATIM</p>
                    <img src="<?= BASEURL; ?>/public/arsha/img/logo.png" width="55%" alt="">
                </div>
                <div class="col-md-5 footer-contact mt-0 mt-xs-2">
                    <p>
                        Kantor Pusat <br>
                        Pondok Pesantren Matholi'ul Anwar<br>
                        Simo Sungelebak Karanggeneng Lamongan<br><br>
                        <strong>Telp : </strong> <a href="https://wa.me/6285655352223" target="_blank">+6285655352223</a><br>
                    </p>
                </div>
                <div class="col-md-4 footer-contact">
                    <p>Temukan Kami di</p>
                    <div class="social-links my-3">
                        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="https://ppmawar.or.id/maal" class="facebook"><i class="bx bx-world"></i></a>
                        <a href="https://www.instagram.com/ksppsmawarsimo" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
                    </div>
                    <div>
                        &copy; Copyright <strong><span>2021</span></strong>. All Rights Reserved<br>Designed By <a href="">TIM IT MAWAR</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col text-center"></div>
            </div>
        </div>
    </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top"><i class="ri-arrow-up-line"></i></a>
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/php-email-form/validate.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/venobox/venobox.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/aos/aos.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/js/main.js"></script>

<script>
$(document).ready(function() {
    // Fungsi format angka rupiah singkat
    function formatRupiah(value) {
        var abs = Math.abs(value);
        if (abs >= 1000000000) {
            var result = (value / 1000000000);
            return 'Rp.' + (result % 1 === 0 ? result : result.toFixed(1)) + ' M';
        } else if (abs >= 1000000) {
            var result = (value / 1000000);
            return 'Rp.' + (result % 1 === 0 ? result : result.toFixed(1)) + ' JT';
        } else if (abs >= 1000) {
            var result = (value / 1000);
            return 'Rp.' + (result % 1 === 0 ? result : result.toFixed(1)) + ' RB';
        } else {
            return 'Rp.' + value;
        }
    }

    // Fungsi render grafik (digunakan juga di halaman perkembangan)
    window.renderChart = function(id, label, sourceData, color, unit, filterZero, chartType = 'line') {
        var el = document.getElementById(id);
        if (!el) return;

        var filteredLabels = [];
        var filteredValues = [];

        Object.keys(sourceData).forEach(function(key) {
            var value = parseFloat(sourceData[key]);
            if (!filterZero || value > 0) {
                filteredLabels.push(key);
                filteredValues.push(value);
            }
        });

        if (filteredLabels.length === 0) return;

        var ctx = el.getContext('2d');
        new Chart(ctx, {
            type: chartType,
            data: {
                labels: filteredLabels,
                datasets: [{
                    label: label,
                    backgroundColor: chartType === 'line' ? 'rgba(55, 81, 126, 0.2)' : color,
                    borderColor: color,
                    borderWidth: chartType === 'line' ? 3 : 1,
                    pointRadius: chartType === 'line' ? 4 : 0,
                    data: filteredValues,
                    fill: chartType === 'line'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var value = tooltipItem.yLabel;
                            if (unit === 'Rp') {
                                return label + ': Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                            return label + ': ' + value + '%';
                        }
                    }
                },
                scales: {
                    xAxes: [{ gridLines: { display: false } }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                if (unit === 'Rp') {
                                    return formatRupiah(value);
                                }
                                return value + '%';
                            }
                        }
                    }]
                }
            }
        });
    };

    // Ambil data grafik untuk halaman utama
    $.ajax({
        url: '<?= BASEURL; ?>/index.php?url=home/get_grafik',
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            if (data.uang) renderChart('uang', 'Wakaf Uang (Asset)', data.uang, '#37517e', 'Rp', false, 'line');
            if (data.hasil) renderChart('grafik_hasil', 'Hasil Pengelolaan (%)', data.hasil, '#28a745', '%', true, 'line');
            if (data.penyaluran) renderChart('grafik_penyaluran', 'Penyaluran Wakaf', data.penyaluran, 'rgba(40, 167, 69, 0.7)', 'Rp', true, 'line');
            if (data.basmalah) renderChart('basmalah', 'Wakaf Basmalah', data.basmalah, '#444444', 'Rp', false, 'line');
        }
    });
});
</script>
</body>
</html>