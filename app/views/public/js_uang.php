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

<script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.23/js/dataTables.bootstrap4.min.js"></script>

<!-- Template Main JS File -->
<script src="<?= BASEURL; ?>/public/arsha/js/main.js"></script>

<script>
$(document).ready(function() {
    $.ajax({
        url: '<?= BASEURL ?>' + '/page/data_uang',
        type: 'POST',
        dataType: 'JSON',
        success: function(data) {

            // ── Hitung total nominal ──────────────────────────────
            var total = 0;
            for (var i = 0; i < data.length; i++) {
                total += (data[i].nominal_raw || 0);
            }
            var fmt = 'Rp.\u00a0' + total.toLocaleString('id-ID');
            $('#total-nominal-display').text(fmt);
            $('#tfoot-total').text(fmt);

            // ── DataTable ─────────────────────────────────────────
            $('#example').DataTable({
                data: data,
                scrollX: true,              // geser horizontal di mobile
                order: [[4, 'desc']],
                lengthMenu: [[25, 50, 100, -1], [25, 50, 100, 'Semua']],
                columns: [
                    { data: 'no' },
                    { data: 'nama' },
                    { data: 'alamat' },
                    {
                        data: 'nominal',
                        render: function(d, type, row) {
                            if (type === 'display') return '<span style="white-space:nowrap">' + d + '</span>';
                            return row.nominal_raw; // sort/filter by raw number
                        }
                    },
                    {
                        data: 'tgl',
                        render: function(d, type, row) {
                            return (type === 'display' || type === 'filter') ? row.tgl_fmt : d;
                        }
                    }
                ],
                columnDefs: [
                    { className: 'text-center', targets: [0, 1, 2] },
                    { className: 'text-right',  targets: [3] },
                    { orderable: false,          targets: [0] }
                ],

                // ── NO terbesar di atas, NO 1 di paling bawah ────
                drawCallback: function() {
                    var api = this.api();
                    var start    = api.context[0]._iDisplayStart;
                    var filtered = api.rows({ search: 'applied' }).count();
                    api.column(0, { search: 'applied', order: 'applied' })
                        .nodes()
                        .each(function(cell, i) {
                            cell.innerHTML = filtered - start - i;
                        });
                },

                language: {
                    search:     'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ data',
                    info:       'Menampilkan _START_ s/d _END_ dari _TOTAL_ data',
                    infoEmpty:  'Tidak ada data',
                    zeroRecords:'Data tidak ditemukan',
                    paginate:   { first:'Pertama', last:'Terakhir', next:'›', previous:'‹' }
                }
            });
        }
    });
});
</script>

</body>
</html>