<style>
    #example {
        table-layout: auto;
    }
    #example th, #example td {
        vertical-align: middle !important;
    }
    #example td {
        /* height pada <td> berlaku sebagai min-height — baris seragam setinggi baris paling tinggi */
        height: 100px;
        padding: 12px 10px !important;
    }
    #example th {
        padding: 12px 10px !important;
        white-space: nowrap;
    }
    /* Kolom URAIAN: tidak patah baris, otomatis selebar teks terpanjang */
    #example td:nth-child(2),
    #example th:nth-child(2) {
        white-space: nowrap;
    }
</style>

<div class="container" style="margin-top: 100px;">
    <h4 class="text-center mb-2" style="color:#37517e;">DAFTAR WAKAF ASSET</h4>
    
    <!-- Tombol Sinkronisasi Data Manual -->
    <div class="text-center mb-3">
        <button id="btn-sync-gsheet" class="btn btn-sm shadow-sm" style="background:#e9c46a; color:#1a2d4f; font-weight:600; border-radius:6px; font-size:0.75rem; font-family:'Poppins',sans-serif; padding:4px 12px; transition:0.3s;">
            <i class="bx bx-sync"></i> Sinkronisasi Data Manual
        </button>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
            <table id="example" class="table table-sm table-bordered" style="color: #37517e;">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">NO</th>
                        <th class="text-center">URAIAN</th>
                        <th class="text-center" style="width: 300px;">DOKUMEN</th>
                        <th class="text-center" style="width: 320px;">KETERANGAN</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
            </div>
        </div>
    </div>
</div>