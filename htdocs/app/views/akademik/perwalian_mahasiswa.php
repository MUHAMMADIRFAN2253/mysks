<div class="bg-black">
    <h1 class="h3 text-info my-4">Kartu Perwalian</h1>

    <?php
    $detail = $data['detail_perwalian'];
    ?>
    
    <?php if ($detail): ?>
        
        <div class="card shadow mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="m-0 font-weight-bold">Informasi Akademik Anda</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>NIM:</strong> <?= $detail['nim']; ?></p>
                        <p><strong>Nama Lengkap:</strong> <?= $detail['nama_mahasiswa']; ?></p>
                        <p><strong>Jurusan:</strong> <?= $detail['jurusan']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Kelas:</strong> <?= $detail['kelas_tahun_akademik']; ?></p>
                        <p><strong>Status Aktif:</strong> 
                        <span class="badge
                            <?php 
                            if ($detail['status_akademik'] == 'Aktif') {
                                echo 'bg-success text-white';
                            } elseif ($detail['status_akademik'] == 'Cuti') {
                                echo 'bg-warning text-dark';
                            } else {
                                echo 'bg-danger text-white';
                            }
                            ?>
                            ">
                            <?= $detail['status_akademik']; ?>
                        </span>
                        <p><strong>Status Kelulusan:</strong> <span class="badge bg-warning text-dark">Sedang Studi</span></p> 
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header bg-info text-white">
                <h5 class="m-0 font-weight-bold">Dosen Pembimbing Akademik (Dosen Wali)</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>NIP:</strong> <?= $detail['nip_pa']; ?></p>
                        <p><strong>Nama Dosen:</strong> <?= $detail['nama_dosen']; ?></p>
                    </div>
                    <div class="col-md-6">
                        <a href="#" class="btn btn-sm btn-outline-info mt-2">Hubungi Dosen Wali</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="m-0 font-weight-bold">Riwayat Studi Singkat</h5>
            </div>
            <div class="card-body">
                <p>Silakan lihat menu Transkrip Nilai untuk detail SKS dan IPK.</p>
            </div>
        </div>

    <?php else: ?>
        <div class="alert alert-danger text-center">
            Data Perwalian Anda tidak ditemukan atau NIP Dosen Wali belum diatur.
        </div>
    <?php endif; ?>
</div>
