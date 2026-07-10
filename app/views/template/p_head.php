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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap.min.css">


    <!-- Template Main CSS File -->
    <link href="<?= BASEURL; ?>/public/arsha/css/style.css" rel="stylesheet">

    <style>
        .dataTables_filter, .dataTables_length, .dataTables_length select,
        .dataTables_length select option { color: #37517e; }

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
    <header id="header" class="fixed-top" style="background-color: #37517e;">
        <div class="container d-flex align-items-center">

            <h1 class="logo mr-auto"><a href="<?= BASEURL; ?>">KSPPS MAWAR</a></h1>
            <nav class="nav-menu d-none d-lg-block">
                <ul>
                    <li><a href="<?= BASEURL ?>">Home</a></li>
                    <li class="drop-down"><a href="#">Wakaf</a>
                        <ul>
                            <li><a href="<?= BASEURL; ?>/page/wakaf_uang">Wakaf Uang</a></li>
                            <li><a href="<?= BASEURL; ?>/page/wakaf_asset">Wakaf Asset</a></li>
                            <li><a href="<?= BASEURL; ?>/page/wakaf_polis">Wakaf Polis</a></li>
                            <li><a href="<?= BASEURL; ?>/page/wakaf_basmalah">Wakaf Toko Basmalah</a></li>
                        </ul>
                    </li>
                    <li class="drop-down"><a href="#">Laporan</a>
                    <ul>
                        <li><a href="#">2020</a></li>
                        <li><a href="#">2021</a></li>
                    </ul>
                </li>
                <!-- Tombol Unit Tamwil -->
                <li class="btn-tamwil">
                    <a href="https://kopma.ppmawar.or.id/" target="_blank">
                        <i class="bx bx-buildings"></i> Unit Tamwil
                    </a>
                </li>
            </ul>
        </nav><!-- .nav-menu -->

        </div>
    </header><!-- End Header -->