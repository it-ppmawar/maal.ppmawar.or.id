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
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap.min.js"></script>

<!-- Template Main JS File -->
<script src="<?= BASEURL; ?>/public/arsha/js/main.js"></script>

<script>
    $(document).ready(function () {

        /* ── Inisialisasi DataTable (data diisi via AJAX di bawah) ── */
        var table = $('#example').DataTable({
            processing   : true,
            autoWidth    : false,
            columns      : [
                { data: 'no',  className: 'text-center', width: '50px' },
                { data: 'uraian' },
                { data: 'dok', className: 'text-center', width: '300px' },
                { data: 'ket', className: 'text-center', width: '320px' }
            ],
            language: {
                processing : 'Memuat data dari Google Sheets…',
                search     : 'Cari:',
                lengthMenu : 'Tampilkan _MENU_ entri',
                info       : 'Menampilkan _START_–_END_ dari _TOTAL_ entri',
                paginate   : { previous: 'Sebelumnya', next: 'Berikutnya' }
            },
            drawCallback: function () {
                this.api().columns.adjust();
            },
            /* Render kolom DOKUMEN & KETERANGAN sebagai HTML (mengandung <a href>) */
            createdRow: function (row, data) {
                $('td:eq(2)', row).html(data.dok);
                $('td:eq(3)', row).html(data.ket);
            }
        });

        /* ── Fungsi untuk memuat data dari Google Sheets via endpoint PHP ── */
        function loadData(callback) {
            $.ajax({
                url      : '<?= BASEURL; ?>/page/data_aset_gsheet',
                type     : 'GET',
                dataType : 'json',
                success  : function (data) {
                    if (!Array.isArray(data) || data.length === 0) {
                        console.warn('Data Wakaf Aset kosong atau gagal diambil.');
                        if (callback) callback(false);
                        return;
                    }
                    table.clear().rows.add(data).draw();
                    table.columns.adjust();
                    if (callback) callback(true);
                },
                error: function (xhr, status, err) {
                    console.error('Gagal memuat data Wakaf Aset:', status, err);
                    if (callback) callback(false);
                }
            });
        }

        /* ── Ambil data saat halaman pertama kali dibuka ── */
        loadData();

        /* ── Event Listener Tombol Sinkronisasi Data Manual ── */
        $('#btn-sync-gsheet').on('click', function () {
            var btnSync = $(this);
            var originalText = btnSync.html();
            
            btnSync.prop('disabled', true);
            btnSync.css('opacity', '0.8');
            btnSync.html('<i class="bx bx-loader-alt bx-spin"></i> Menyinkronkan...');

            loadData(function (success) {
                if (success) {
                    btnSync.html('<i class="bx bx-check"></i> Berhasil Diperbarui!');
                    btnSync.css({ 'background': '#28a745', 'color': '#fff' });
                } else {
                    btnSync.html('<i class="bx bx-x"></i> Gagal Menyinkronkan');
                    btnSync.css({ 'background': '#dc3545', 'color': '#fff' });
                }

                setTimeout(function () {
                    btnSync.prop('disabled', false);
                    btnSync.css('opacity', '1');
                    btnSync.css({ 'background': '#e9c46a', 'color': '#1a2d4f' });
                    btnSync.html(originalText);
                }, 1500);
            });
        });

    });
</script>

</body>
</html>