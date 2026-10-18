<script>
$(document).ready(function() {
    var allData = {}; // menyimpan data dari server
    var charts = {};  // menyimpan instance Chart.js

    // Ambil data dari endpoint yang sama dengan home
    $.ajax({
        url: '<?= BASEURL; ?>/index.php?url=home/get_grafik',
        type: 'GET',
        dataType: 'JSON',
        success: function(data) {
            allData = data;
            // Render semua grafik (tapi kontainernya masih hidden)
            if (data.uang) {
                charts.uang = renderChart('chartUang', 'Wakaf Uang (Asset)', data.uang, '#37517e', 'Rp', false, 'line');
            }
            if (data.hasil) {
                charts.hasil = renderChart('chartHasil', 'Hasil Pengelolaan (%)', data.hasil, '#28a745', '%', true, 'line');
            }
            if (data.penyaluran) {
                charts.penyaluran = renderChart('chartPenyaluran', 'Penyaluran Wakaf', data.penyaluran, 'rgba(40, 167, 69, 0.7)', 'Rp', true, 'line');
            }
            if (data.basmalah) {
                charts.basmalah = renderChart('chartBasmalah', 'Wakaf Basmalah', data.basmalah, '#444444', 'Rp', false, 'line');
            }

            // Cek parameter URL ?kategori=...
            var urlParams = new URLSearchParams(window.location.search);
            var kategori = urlParams.get('kategori');
            if (kategori) {
                showGrafik(kategori);
                $('.btn-kategori[data-target="' + kategori + '"]').addClass('active');
            }
        }
    });

    // Fungsi format angka rupiah singkat
    function formatRupiah(value) {
        var abs = Math.abs(value);
        var sign = value < 0 ? '-' : '';
        if (abs >= 1000000000) {
            var result = (abs / 1000000000);
            return 'Rp. ' + sign + (result % 1 === 0 ? result : result.toFixed(1).replace('.', ',')) + ' M';
        } else if (abs >= 1000000) {
            var result = (abs / 1000000);
            return 'Rp. ' + sign + (result % 1 === 0 ? result : result.toFixed(1).replace('.', ',')) + ' JT';
        } else if (abs >= 1000) {
            var result = (abs / 1000);
            return 'Rp. ' + sign + (result % 1 === 0 ? result : result.toFixed(1).replace('.', ',')) + ' RB';
        } else {
            return 'Rp. ' + sign + abs.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    }

    // Fungsi renderChart (sama dengan di all.php, tapi return chart instance)
    window.renderChart = function(id, label, sourceData, color, unit, filterZero, chartType = 'line') {
        var el = document.getElementById(id);
        if (!el) return null;

        var filteredLabels = [];
        var filteredValues = [];

        Object.keys(sourceData).forEach(function(key) {
            var value = parseFloat(sourceData[key]);
            if (!filterZero || value > 0) {
                filteredLabels.push(key);
                filteredValues.push(value);
            }
        });

        if (filteredLabels.length === 0) return null;

        // Hitung rata-rata
        var sum = filteredValues.reduce(function(a, b) { return a + b; }, 0);
        var avg = sum / filteredValues.length;

        var avgBrief = (unit === 'Rp') ? formatRupiah(avg) : (avg.toFixed(2).replace('.', ',') + '%');
        var avgFull = (unit === 'Rp') 
            ? ('Rp. ' + Math.round(avg).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")) 
            : (avg.toFixed(2).replace('.', ',') + '%');

        // Tampilkan badge info rata-rata di bawah canvas jika ada/diperlukan
        var badgeContainer = document.getElementById('badge-' + id);
        if (badgeContainer) {
            badgeContainer.innerHTML = '<span class="badge-avg" title="Rata-rata: ' + avgFull + '">' +
                '<i class="bx bx-line-chart mr-1" style="color: #e74c3c; font-size: 1.05rem; vertical-align: -1px;"></i>' +
                'Rata-rata: <strong>' + avgBrief + '</strong> / tahun' +
                '</span>';
        }

        var ctx = el.getContext('2d');
        return new Chart(ctx, {
            type: chartType,
            data: {
                labels: filteredLabels,
                datasets: [
                    {
                        label: label,
                        backgroundColor: chartType === 'line' ? 'rgba(55, 81, 126, 0.2)' : color,
                        borderColor: color,
                        borderWidth: chartType === 'line' ? 3 : 1,
                        pointRadius: chartType === 'line' ? 4 : 0,
                        pointHoverRadius: 6,
                        data: filteredValues,
                        fill: chartType === 'line'
                    },
                    {
                        label: 'Rata-rata: ' + avgBrief,
                        data: Array(filteredValues.length).fill(avg),
                        borderColor: '#e74c3c',
                        borderWidth: 2,
                        borderDash: [6, 5],
                        pointRadius: 0,
                        pointHoverRadius: 4,
                        pointBackgroundColor: '#e74c3c',
                        fill: false,
                        isAverage: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: true,
                    labels: {
                        boxWidth: 28,
                        fontSize: 11,
                        padding: 10
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, chartData) {
                            var dataset = chartData.datasets[tooltipItem.datasetIndex];
                            var value = tooltipItem.yLabel;
                            if (dataset && dataset.isAverage) {
                                if (unit === 'Rp') {
                                    return 'Rata-rata: Rp. ' + Math.round(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                                }
                                return 'Rata-rata: ' + value.toFixed(2).replace('.', ',') + '%';
                            }
                            var dsLabel = (dataset && dataset.label) ? dataset.label : label;
                            if (unit === 'Rp') {
                                return dsLabel + ': Rp. ' + Math.round(value).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                            }
                            return dsLabel + ': ' + value + '%';
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

    // Fungsi untuk menampilkan satu grafik berdasarkan kategori
    function showGrafik(kategori) {
        $('.grafik-container').hide();
        switch (kategori) {
            case 'uang': $('#grafikUang').show(); break;
            case 'hasil': $('#grafikHasil').show(); break;
            case 'penyaluran': $('#grafikPenyaluran').show(); break;
            case 'basmalah': $('#grafikBasmalah').show(); break;
        }
    }

    // Event handler tombol kategori
    $('.btn-kategori').click(function() {
        var target = $(this).data('target');
        $('.btn-kategori').removeClass('active');
        $(this).addClass('active');
        showGrafik(target);
    });

    // Tombol tampilkan semua
    $('#btnShowAll').click(function() {
        $('.grafik-container').show();
        $('.btn-kategori').removeClass('active');
    });

    // Tombol sembunyikan semua
    $('#btnHideAll').click(function() {
        $('.grafik-container').hide();
        $('.btn-kategori').removeClass('active');
    });
});
</script>