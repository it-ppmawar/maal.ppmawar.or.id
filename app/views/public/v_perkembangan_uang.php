<!-- ============================================================
     FILE : app/views/public/v_perkembangan_uang.php
     Route: /page/perkembangan_uang
     ============================================================ -->

<!-- ======= Header (sama persis halaman utama) ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <h1 class="logo mr-auto"><a href="<?= BASEURL ?>">KSPPS MAWAR</a></h1>
        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li><a href="<?= BASEURL ?>">Home</a></li>
                <li><a href="<?= BASEURL ?>/#services">Perkembangan</a></li>
                <li class="drop-down"><a href="#">Wakaf</a>
                    <ul>
                        <li><a href="<?= BASEURL; ?>/page/wakaf_uang">Wakaf Uang</a></li>
                        <li><a href="<?= BASEURL; ?>/page/wakaf_asset">Wakaf Asset</a></li>
                        <li><a href="<?= BASEURL; ?>/page/wakaf_polis">Wakaf Polis</a></li>
                        <li><a href="<?= BASEURL; ?>/page/wakaf_basmalah">Wakaf Toko Basmalah</a></li>
                    </ul>
                </li>
                <li class="drop-down"><a href="#">Laporan RAT</a>
                    <ul>
                        <li><a href="#">2020</a></li>
                        <li><a download href="<?= BASEURL; ?>/public/LPJ RAT 2021.pdf">2021</a></li>
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
            </ul>
        </nav>
    </div>
</header>

<!-- ======= Page Hero ======= -->
<section style="
    background: linear-gradient(135deg, #1a2d4f 0%, #243a63 60%, #1e4d8c 100%);
    padding: 100px 0 60px;
    text-align: center;
    position: relative;
    overflow: hidden;
">
    <div style="
        position:absolute;inset:0;
        background:url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.04\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');
    "></div>
    <div class="container" style="position:relative">
        <span style="
            display:inline-block;background:#e9c46a;color:#1a2d4f;
            font-size:.75rem;font-weight:700;padding:4px 16px;
            border-radius:20px;letter-spacing:.5px;margin-bottom:14px;
        ">UNIT MAAL</span>
        <h2 style="font-family:'Poppins',sans-serif;color:#fff;font-size:clamp(1.6rem,4vw,2.4rem);font-weight:700;margin-bottom:10px;">
            Perkembangan Wakaf Uang
        </h2>
        <p style="color:rgba(255,255,255,.72);font-size:.93rem;max-width:520px;margin:0 auto;">
            Rincian perkembangan tiap akun Wakaf Uang yang dikelola KSPPS MAWAR Jatim dari tahun ke tahun
        </p>
    </div>
</section>

<main id="main">
<section class="section-bg" style="padding: 40px 0 60px;">
<div class="container">

    <!-- Control Bar -->
    <div class="d-flex justify-content-between align-items-center flex-wrap mb-4" style="gap:12px;">
        <div style="font-size:.88rem;color:#718096;">
            Menampilkan <strong id="jumlah-akun" style="color:#1a2d4f;">—</strong> akun wakaf
        </div>
        <div style="display:flex;gap:10px;flex-wrap:wrap;">
            <button id="btn-toggle-all" onclick="toggleAll()"
                style="display:flex;align-items:center;gap:8px;padding:9px 20px;border-radius:8px;
                       font-size:.85rem;font-weight:600;cursor:pointer;border:2px solid #37517e;
                       background:#37517e;color:#fff;transition:all .2s;">
                <i class='bx bx-show'></i>
                <span id="btn-toggle-all-text">Tampilkan Semua Grafik</span>
            </button>
            <button onclick="location.href='<?= BASEURL ?>'"
                style="display:flex;align-items:center;gap:8px;padding:9px 20px;border-radius:8px;
                       font-size:.85rem;font-weight:600;cursor:pointer;border:2px solid #37517e;
                       background:transparent;color:#37517e;transition:all .2s;">
                <i class='bx bx-arrow-back'></i> Kembali
            </button>
        </div>
    </div>

    <!-- Loading State -->
    <div id="loading-state" class="text-center py-5">
        <div class="spinner-border" style="color:#37517e;" role="status"></div>
        <p class="mt-3" style="color:#718096;font-size:.9rem;">Memuat data dari Google Sheets...</p>
    </div>

    <!-- Error State -->
    <div id="error-state" class="text-center py-5" style="display:none;">
        <i class='bx bx-error-circle' style="font-size:3rem;color:#e74c3c;"></i>
        <p class="mt-3" style="color:#718096;">Gagal memuat data. Silakan refresh halaman.</p>
        <button onclick="fetchData()" class="btn btn-primary mt-2">Coba Lagi</button>
    </div>

    <!-- Daftar Akun (1 per baris) -->
    <div id="accounts-list" style="display:none;"></div>

</div>
</section>
</main>

<style>
/* ── Akun Row ── */
.akun-row {
    background: #fff;
    border: 1px solid #dde4ef;
    border-radius: 14px;
    margin-bottom: 16px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(26,45,79,.05);
    transition: box-shadow .25s;
}
.akun-row:hover { box-shadow: 0 6px 24px rgba(26,45,79,.10); }

.akun-row-header {
    padding: 16px 22px;
    display: flex;
    align-items: center;
    gap: 14px;
    cursor: pointer;
    user-select: none;
    border-bottom: 1px solid transparent;
    transition: border-color .2s, background .2s;
}
.akun-row.open .akun-row-header {
    border-bottom-color: #dde4ef;
    background: #f8fafd;
}
.akun-row-header:hover { background: #f4f7fb; }

.akun-icon-box {
    width: 44px; height: 44px;
    border-radius: 10px;
    background: linear-gradient(135deg, #1a2d4f, #243a63);
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
}
.akun-icon-box i { color: #e9c46a; font-size: 1.3rem; }

.akun-info { flex: 1; min-width: 0; }
.akun-info .nama {
    font-weight: 600; font-size: .92rem; color: #1a2d4f; margin-bottom: 3px;
}
.akun-info .latest { font-size: .80rem; color: #718096; }
.akun-info .latest span { color: #2a9d8f; font-weight: 600; }

.akun-no {
    font-size: .78rem; color: #a0aec0; font-weight: 500;
    background: #f4f7fb; padding: 3px 10px; border-radius: 20px;
    flex-shrink: 0;
}

.chevron-box {
    width: 30px; height: 30px; border-radius: 50%;
    background: #f4f7fb; display: flex; align-items: center; justify-content: center;
    transition: background .2s;
    flex-shrink: 0;
}
.chevron-box i { font-size: 1.15rem; color: #37517e; transition: transform .3s; }
.akun-row.open .chevron-box { background: #37517e; }
.akun-row.open .chevron-box i { color: #fff; transform: rotate(180deg); }

/* ── Chart Body ── */
.akun-row-body {
    max-height: 0;
    overflow: hidden;
    transition: max-height .45s cubic-bezier(.4,0,.2,1);
}
.akun-row.open .akun-row-body { max-height: 380px; }

.chart-inner {
    padding: 20px 22px 22px;
    height: 300px;
}
.chart-inner canvas { width: 100% !important; height: 100% !important; }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script>
var chartInstances = {};
var akunData       = [];
var allOpen        = false;

// ── Format Rupiah ──
function fmtRp(val) {
    val = parseFloat(val);
    if (val >= 1e9) return 'Rp ' + (val/1e9).toFixed(2).replace('.',',') + ' M';
    if (val >= 1e6) return 'Rp ' + (val/1e6).toFixed(1).replace('.',',') + ' Jt';
    return 'Rp ' + val.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g,'.');
}
function fmtRpFull(val) {
    return 'Rp ' + parseFloat(val).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g,'.');
}

// ── Fetch data dari controller ──
function fetchData() {
    document.getElementById('loading-state').style.display = 'block';
    document.getElementById('error-state').style.display   = 'none';
    document.getElementById('accounts-list').style.display = 'none';

    $.ajax({
        url: '<?= BASEURL ?>/index.php?url=page/get_wakaf_uang_json',
        type: 'GET',
        dataType: 'JSON',
        timeout: 15000,
        success: function(data) {
            if (!data || data.length === 0) {
                document.getElementById('loading-state').style.display = 'none';
                document.getElementById('error-state').style.display   = 'block';
                return;
            }
            akunData = data;
            buildList();
        },
        error: function() {
            document.getElementById('loading-state').style.display = 'none';
            document.getElementById('error-state').style.display   = 'block';
        }
    });
}

// ── Build daftar akun (1 per baris) ──
function buildList() {
    var list = document.getElementById('accounts-list');
    list.innerHTML = '';

    akunData.forEach(function(akun, idx) {
        var years  = Object.keys(akun.data);
        var latest = akun.data[years[years.length - 1]];

        var row = document.createElement('div');
        row.className = 'akun-row';
        row.id = 'row-' + idx;

        row.innerHTML =
            '<div class="akun-row-header" onclick="toggleRow(' + idx + ')">' +
                '<div class="akun-icon-box"><i class="bx bx-dollar-circle"></i></div>' +
                '<div class="akun-info">' +
                    '<div class="nama">' + akun.nama + '</div>' +
                    '<div class="latest">Per ' + years[years.length-1] + ': <span>' + fmtRp(latest) + '</span></div>' +
                '</div>' +
                '<span class="akun-no">No. ' + akun.no + '</span>' +
                '<div class="chevron-box"><i class="bx bx-chevron-down"></i></div>' +
            '</div>' +
            '<div class="akun-row-body" id="body-' + idx + '">' +
                '<div class="chart-inner"><canvas id="chart-' + idx + '"></canvas></div>' +
            '</div>';

        list.appendChild(row);
    });

    document.getElementById('jumlah-akun').textContent = akunData.length;
    document.getElementById('loading-state').style.display = 'none';
    document.getElementById('accounts-list').style.display = 'block';
}

// ── Render Chart.js ──
function renderChart(idx) {
    if (chartInstances[idx]) return;
    var akun   = akunData[idx];
    var years  = Object.keys(akun.data);
    var values = years.map(function(y){ return parseFloat(akun.data[y]); });

    var ctx = document.getElementById('chart-' + idx).getContext('2d');
    chartInstances[idx] = new Chart(ctx, {
        type: 'line',
        data: {
            labels: years,
            datasets: [{
                label: akun.nama,
                data: values,
                backgroundColor: 'rgba(55,81,126,0.12)',
                borderColor: '#37517e',
                borderWidth: 2.5,
                pointBackgroundColor: '#e9c46a',
                pointBorderColor: '#37517e',
                pointRadius: 5,
                pointHoverRadius: 7,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: { display: false },
            tooltips: {
                callbacks: {
                    label: function(item) { return fmtRpFull(item.yLabel); }
                }
            },
            scales: {
                xAxes: [{ gridLines: { display: false } }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(v){ return fmtRp(v); }
                    },
                    gridLines: { color: 'rgba(0,0,0,0.05)' }
                }]
            }
        }
    });
}

// ── Toggle satu baris ──
function toggleRow(idx) {
    var row = document.getElementById('row-' + idx);
    var isOpen = row.classList.contains('open');
    if (isOpen) {
        row.classList.remove('open');
    } else {
        row.classList.add('open');
        setTimeout(function(){ renderChart(idx); }, 50);
    }
    syncToggleAllBtn();
}

// ── Toggle semua ──
function toggleAll() {
    allOpen = !allOpen;
    akunData.forEach(function(_, idx) {
        var row = document.getElementById('row-' + idx);
        if (allOpen) {
            row.classList.add('open');
            setTimeout(function(){ renderChart(idx); }, 50 + idx * 15);
        } else {
            row.classList.remove('open');
        }
    });
    syncToggleAllBtn();
}

function syncToggleAllBtn() {
    var openCount = document.querySelectorAll('.akun-row.open').length;
    var btn  = document.getElementById('btn-toggle-all');
    var text = document.getElementById('btn-toggle-all-text');
    if (openCount === akunData.length && akunData.length > 0) {
        allOpen = true;
        btn.querySelector('i').className = 'bx bx-hide';
        text.textContent = 'Sembunyikan Semua Grafik';
        btn.style.background = 'transparent';
        btn.style.color = '#37517e';
    } else {
        allOpen = false;
        btn.querySelector('i').className = 'bx bx-show';
        text.textContent = 'Tampilkan Semua Grafik';
        btn.style.background = '#37517e';
        btn.style.color = '#fff';
    }
}

// ── Init ──
$(document).ready(function() { fetchData(); });
</script>