<!-- Vendor JS Files -->
<script src="<?= BASEURL; ?>/public/arsha/vendor/jquery/jquery.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/jquery.easing/jquery.easing.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/php-email-form/validate.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/waypoints/jquery.waypoints.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/venobox/venobox.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/owl.carousel/owl.carousel.min.js"></script>
<script src="<?= BASEURL; ?>/public/arsha/vendor/aos/aos.js"></script>

<!-- Template Main JS File -->
<script src="<?= BASEURL; ?>/public/arsha/js/main.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.2/papaparse.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
// ══════════════════════════════════════════════════════════════
// DATA FALLBACK (dari PHP — selalu tersedia, halaman langsung tampil)
// ══════════════════════════════════════════════════════════════
var AKUN_DATA = <?= $GLOBALS['akun_json_data'] ?>;

// Endpoint CSV Langsung dari Tab "Data Mauquf Alaih" (Menggantikan GAS URL)
var LIVE_CSV_URL = 'https://docs.google.com/spreadsheets/d/e/2PACX-1vRYWArtmSJU9igeOkV-WvOk9x623BscfGYmXqc9a458gCXPGXMK4tQF7XRb-g5M_x9FQt_3Cg_hFdGz/pub?gid=405205981&single=true&output=csv';

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
        var openRows = document.querySelectorAll('.akun-row.open');
        openRows.forEach(function(r) {
            var idx = r.id.replace('row-', '');
            renderMonthlySection(idx);
        });
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

        var va_bsi  = akun.va_bsi || '';
        var va_lain = akun.va_lain || '';
        var vaBar = '';
        if (va_bsi || va_lain) {
            vaBar += '<div class="va-bar-container">';
            if (va_bsi) {
                vaBar += '<div class="va-bar">' +
                            '<span class="va-label"><i class="bx bx-credit-card"></i>VA BSI</span>' +
                            '<div class="va-action">' +
                                '<span class="va-number" id="va-bsi-' + idx + '">' + va_bsi + '</span>' +
                                '<button class="btn-copy" id="btn-copy-bsi-' + idx + '" onclick="copyVA(event, \'va-bsi-' + idx + '\', \'btn-copy-bsi-' + idx + '\')">' +
                                    '<i class="bx bx-copy"></i> Salin' +
                                '</button>' +
                            '</div>' +
                         '</div>';
            }
            if (va_lain) {
                vaBar += '<div class="va-bar">' +
                            '<span class="va-label"><i class="bx bx-credit-card"></i>VA Bank Lain</span>' +
                            '<div class="va-action">' +
                                '<span class="va-number" id="va-lain-' + idx + '">' + va_lain + '</span>' +
                                '<button class="btn-copy" id="btn-copy-lain-' + idx + '" onclick="copyVA(event, \'va-lain-' + idx + '\', \'btn-copy-lain-' + idx + '\')">' +
                                    '<i class="bx bx-copy"></i> Salin' +
                                '</button>' +
                            '</div>' +
                         '</div>';
            }
            vaBar += '</div>';
        }

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
            vaBar +
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
    if (!wrap) return;
    
    var akun = AKUN_DATA[idx];
    if (!akun) return;
    var no = akun.no;
    
    if(!monthlyDataLoaded) {
        wrap.innerHTML = '<div style="text-align:center;font-size:0.8rem;color:#718096;padding:10px;"><i class="bx bx-loader-alt bx-spin"></i> Memuat data bulanan...</div>';
        return;
    }
    
    if(!MONTHLY_DATA[no] || Object.keys(MONTHLY_DATA[no]).length === 0) {
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

// ── Salin VA ──────────────────────────────────────────────────
function copyVA(e, textId, btnId) {
    e.stopPropagation();
    var el  = document.getElementById(textId);
    var btn = document.getElementById(btnId);
    if (!el || !btn) return;
    navigator.clipboard.writeText(el.textContent.trim()).then(function() {
        btn.innerHTML = '<i class="bx bx-check"></i> Tersalin!';
        btn.classList.add('copied');
        setTimeout(function() {
            btn.innerHTML = '<i class="bx bx-copy"></i> Salin';
            btn.classList.remove('copied');
        }, 2000);
    }).catch(function() {
        var range = document.createRange();
        range.selectNode(el);
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand('copy');
        window.getSelection().removeAllRanges();
        btn.innerHTML = '<i class="bx bx-check"></i> Tersalin!';
        btn.classList.add('copied');
        setTimeout(function() {
            btn.innerHTML = '<i class="bx bx-copy"></i> Salin';
            btn.classList.remove('copied');
        }, 2000);
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
        var noStr = String(item['NO'] || item['no'] || '').trim();
        if (noStr === '' || isNaN(parseInt(noStr, 10))) return null; // Abaikan baris rekap (JUMLAH, dll)
        
        var no   = parseInt(noStr, 10);
        var nama = item['REKENING (AKUN)'] || item['nama'] || item['NAMA'] || ('Akun ' + no);
        // Ambil data tahun
        var data = {};
        YEARS.forEach(function(y) {
            var v = item[y];
            if (v !== '' && v !== null && v !== undefined) {
                // Hapus koma pemisah ribuan dari format CSV (contoh "397,154,884" -> "397154884")
                var cleanV = String(v).replace(/,/g, '');
                if (!isNaN(parseFloat(cleanV))) {
                    data[y] = parseFloat(cleanV);
                }
            }
        });
        // Jika tidak ada data tahun sama sekali, skip
        if (Object.keys(data).length === 0) return null;

        // Ambil icon & VA dari fallback data jika ada (berdasarkan no), atau default
        var fallback = AKUN_DATA.find(function(a){ return a.no == no; });
        var icon = (fallback && fallback.icon) ? fallback.icon : (ICONS[(no - 1) % ICONS.length] || 'bx-dollar-circle');
        
        var va_bsi  = item['VA BSI'] || (fallback && fallback.va_bsi ? fallback.va_bsi : '');
        var va_lain = item['VA BANK LAIN'] || (fallback && fallback.va_lain ? fallback.va_lain : '');

        return { no: Number(no), nama: String(nama), icon: icon, va_bsi: va_bsi, va_lain: va_lain, data: data };
    }).filter(function(a){ return a !== null && a.nama; });
}

// ══════════════════════════════════════════════════════════════
// FETCH LIVE — dari Google Apps Script
// Dipanggil setelah halaman tampil, tidak memblokir render awal
// ══════════════════════════════════════════════════════════════
function fetchLiveData() {
    var indicator = document.getElementById('live-indicator');
    var badge     = document.getElementById('src-badge');
    if (indicator) indicator.style.display = 'inline';

    var done  = false;
    var timer = setTimeout(function() {
        if (!done) { done = true; if (indicator) indicator.style.display = 'none'; }
    }, 12000);

    Papa.parse(LIVE_CSV_URL, {
        download: true,
        header: true,
        skipEmptyLines: true,
        complete: function(results) {
            if (done) return; done = true;
            clearTimeout(timer);
            if (indicator) indicator.style.display = 'none';

            var json = results.data;
            if (!Array.isArray(json) || json.length === 0) {
                console.warn('CSV kosong atau format salah');
                return;
            }

            var normalized = normalizeGAS(json);
            if (normalized.length === 0) {
                console.warn('Data kosong setelah normalisasi');
                return;
            }

            // Update global & rebuild UI
            AKUN_DATA = normalized;
            buildList(AKUN_DATA);

            // Terapkan ulang pencarian jika sedang aktif
            var q = document.getElementById('search-box').value;
            if (q) doSearch(q);

            if (badge) {
                badge.className = 'src-badge src-live';
                badge.textContent = 'live';
                badge.title = 'Data langsung dari Google Sheets (' + normalized.length + ' akun)';
            }
            liveLoaded = true;
        },
        error: function(err) {
            if (!done) { done = true; clearTimeout(timer); }
            if (indicator) indicator.style.display = 'none';
            console.warn('Live fetch gagal, menggunakan data cadangan:', err);
            // Badge tetap "cadangan", data PHP tetap digunakan
        }
    });
}

// ══════════════════════════════════════════════════════════════
// SINKRONISASI MANUAL SEMUA DATA
// ══════════════════════════════════════════════════════════════
function syncAllData() {
    var btn = document.getElementById('btn-sync-all');
    if (!btn) return;
    
    var originalText = btn.innerHTML;
    btn.disabled = true;
    btn.style.opacity = '0.8';
    btn.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Menyinkronkan...';
    
    // 1. Muat ulang data live (detail 95 lembaga)
    fetchLiveData();
    
    // 2. Muat ulang data bulanan
    fetchAllMonthlyData();
    
    // 3. Sinkronkan database MySQL (untuk Halaman Utama Daftar Wakaf)
    fetch("<?= BASEURL; ?>/sync_gsheet.php?token=MAWARsync2024")
        .then(function(res) { return res.text(); })
        .then(function() {
            btn.innerHTML = '<i class="bx bx-check"></i> Semua Data Tersinkron!';
            btn.style.background = '#28a745';
            btn.style.borderColor = '#28a745';
            btn.style.color = '#fff';
            
            setTimeout(function() {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.background = '#e9c46a';
                btn.style.borderColor = '#e9c46a';
                btn.style.color = '#1a2d4f';
                btn.innerHTML = originalText;
            }, 3000);
        })
        .catch(function(err) {
            console.warn("DB Sync Error:", err);
            btn.innerHTML = '<i class="bx bx-x"></i> Gagal Sebagian';
            btn.style.background = '#dc3545';
            btn.style.borderColor = '#dc3545';
            btn.style.color = '#fff';
            setTimeout(function() {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.background = '#e9c46a';
                btn.style.borderColor = '#e9c46a';
                btn.style.color = '#1a2d4f';
                btn.innerHTML = originalText;
            }, 3000);
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

