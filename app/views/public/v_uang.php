<div class="container" style="margin-top: 100px;">
    <h4 class="text-center mb-3" style="color:#37517e;">DAFTAR WAKAF UANG</h4>

    <!-- Kartu Total Penerimaan -->
    <div class="row justify-content-center mb-3">
        <div class="col-auto">
            <div style="background:linear-gradient(135deg,#37517e,#1a3357);color:#fff;border-radius:10px;padding:10px 30px;text-align:center;box-shadow:0 4px 15px rgba(55,81,126,.25)">
                <div style="font-size:.75rem;letter-spacing:1px;opacity:.85;text-transform:uppercase">Total Penerimaan Wakaf Uang</div>
                <div id="total-nominal-display" style="font-size:1.35rem;font-weight:700;white-space:nowrap">memuat...</div>
            </div>
            <div class="text-center mt-2" style="display:flex; gap:8px; justify-content:center; flex-wrap:wrap;">
                <button id="btn-sync-gsheet" class="btn btn-sm shadow-sm" style="background:#e9c46a; color:#1a2d4f; font-weight:600; border-radius:6px; font-size:0.75rem; font-family:'Poppins',sans-serif; padding:4px 12px; transition:0.3s;">
                    <i class="bx bx-sync"></i> Sinkronisasi Data Manual
                </button>
                <a href="https://laporan.maal.ppmawar.or.id" target="_blank" class="btn btn-sm shadow-sm" style="background:#2a9d8f; color:#fff; font-weight:600; border-radius:6px; font-size:0.75rem; font-family:'Poppins',sans-serif; padding:4px 12px; transition:0.3s; text-decoration:none;">
                    <i class="bx bx-file-find"></i> Laporan per Lembaga
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <style>
                #example td:nth-child(1),#example th:nth-child(1){width:50px;min-width:50px;text-align:center}
                #example td:nth-child(4),#example th:nth-child(4){white-space:nowrap;text-align:right;min-width:135px}
                #example td:nth-child(5),#example th:nth-child(5){white-space:nowrap}
                #example tfoot th{background:#eef2f9;color:#37517e;font-weight:700;border-top:2px solid #37517e}
            </style>
            <table id="example" class="table table-sm table-bordered" style="color:#37517e;">
                <thead>
                    <tr>
                        <th class="text-center">NO</th>
                        <th class="text-center">NAMA</th>
                        <th class="text-center">ALAMAT</th>
                        <th class="text-center">NOMINAL</th>
                        <th class="text-center">TANGGAL</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td></td><td></td><td></td><td></td><td></td></tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-right" style="padding-right:12px">TOTAL PENERIMAAN WAKAF UANG</th>
                        <th class="text-right" id="tfoot-total" style="white-space:nowrap"></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var btnSync = document.getElementById("btn-sync-gsheet");
    if(btnSync) {
        btnSync.addEventListener("click", function() {
            var originalText = btnSync.innerHTML;
            btnSync.disabled = true;
            btnSync.style.opacity = "0.8";
            btnSync.innerHTML = '<i class="bx bx-loader-alt bx-spin"></i> Menyinkronkan...';
            
            // Endpoint sinkronisasi database MySQL (uang_wakaf)
            fetch("<?= BASEURL; ?>/sync_gsheet.php?token=MAWARsync2024")
                .then(function(response) {
                    if(!response.ok) throw new Error("Network error");
                    return response.text();
                })
                .then(function(text) {
                    btnSync.innerHTML = '<i class="bx bx-check"></i> Berhasil Diperbarui!';
                    btnSync.style.background = '#28a745';
                    btnSync.style.color = '#fff';
                    // Muat ulang halaman agar DataTable menampilkan isi terbaru dari DB
                    setTimeout(function() { window.location.reload(); }, 1200);
                })
                .catch(function(err) {
                    btnSync.innerHTML = '<i class="bx bx-x"></i> Gagal Menyinkronkan';
                    btnSync.style.background = '#dc3545';
                    btnSync.style.color = '#fff';
                    setTimeout(function() {
                        btnSync.disabled = false;
                        btnSync.style.opacity = "1";
                        btnSync.style.background = '#e9c46a';
                        btnSync.style.color = '#1a2d4f';
                        btnSync.innerHTML = originalText;
                    }, 3000);
                });
        });
    }
});
</script>