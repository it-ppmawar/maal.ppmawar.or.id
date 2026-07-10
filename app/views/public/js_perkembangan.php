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

        var ctx = el.getContext('2d');
        return new Chart(ctx, {
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
                                    return 'Rp.' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
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