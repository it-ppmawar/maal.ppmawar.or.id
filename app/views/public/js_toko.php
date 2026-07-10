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
    $(document).ready(function() {
        $.ajax({
            url: '<?= BASEURL ?>' + '/page/data_toko',
            type: 'POST',
            dataType: 'JSON',
            success: function(data) {
                $('#example').DataTable({
                    responsive: true,
                    data: data,
                    columns: [{
                            data: "no"
                        },
                        {
                            data: "tahun"
                        },
                        {
                            data: "laba"
                        },
                        {
                            data: "persen"
                        },
                        {
                            data: "ket"
                        },
                        {
                            data: "link"
                        },
                    ],
                    columnDefs: [{
                        className: "text-center",
                        targets: "_all"
                    }]
                });
            }
        })
    });
</script>

</body>

</html>