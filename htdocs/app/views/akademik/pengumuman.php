                <div class="bg-black">
                    <?php if ($data['role'] === 'dosen'): ?>
                        <h1 class="h3 my-4">Input Pengumuman Mata Kuliah</h1>
                    <?php endif; ?>
                    <?php if ($data['role'] === 'mahasiswa'): ?>
                        <h1 class="h3 my-4">Pengumuman Mata Kuliah</h1>
                    <?php endif; ?>
                    <div class="card mb-4 bg-dark text-white shadow">
                        <?php Flasher::flash('Pengumuman'); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="mb-1"><strong>Kode & Mata Kuliah:</strong> 
                                    <?= $data['detail_mk']['kode_nama_mata_kuliah']; ?>
                                    </p>
                                    <p class="mb-1"><strong>Jenis Perkuliahan:</strong> 
                                    <?= $data['detail_mk']['jenis_perkuliahan']; ?>
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <p class="mb-1"><strong>Kelas & Kode Kelas:</strong> 
                                    <?= $data['detail_mk']['nama_kelas_kode_kelas']; ?>
                                    </p>
                                    <p class="mb-1"><strong>Hari & Jam:</strong> 
                                    <?= $data['detail_mk']['hari_jam']; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($data['role'] === 'dosen'): ?>
                        <a href="#" class="btn btn-warning text-black mb-4 tampilModalTambahPengumuman" data-bs-toggle="modal" data-bs-target="#formPengumuman"> <strong>Tambah Pengumuman</strong> </a>
                    <?php endif; ?>
                    <?php if ($data['role'] === 'mahasiswa'): ?>
                        <h2 class="h5 text-warning mb-3">Daftar Pengumuman</h2>
                    <?php endif; ?>
                    <?php if (!empty($data['pengumuman'])): ?>
                        <?php foreach ($data['pengumuman'] as $pengumuman): ?>
                            <div class="card mb-3 shadow">
                                <div class="card-header bg-warning text-black">
                                    <strong><?= $pengumuman['judul']; ?></strong> 
                                    <small class="float-right text-dark">Diposting: <?= date('d M Y, H:i', strtotime($pengumuman['tanggal_dibuat'])); ?></small>
                                </div>
                                <div class="card-body">
                                    <?= nl2br(htmlspecialchars($pengumuman['isi_pengumuman'])); ?>
                                </div>
                                <?php if ($data['role'] === 'dosen'): ?>
                                <div class="card-footer bg-light text-end">
                                    <a href="<?= BASEURL; ?>/akademik/ubahPengumuman/<?= $pengumuman['id_pengumuman']; ?>/" class="btn btn-sm btn-primary tampilModalUbahPengumuman" data-bs-toggle="modal" data-bs-target="#formPengumuman" 
                                    data-id_pengumuman="<?= $pengumuman['id_pengumuman']; ?>">Edit</a>
                                    
                                    <a href="<?= BASEURL; ?>/Akademik/hapusPengumuman/<?= $pengumuman['id_pengumuman']; ?>/<?= $data['detail_mk']['id_jadwal']; ?>" 
                                    class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Yakin ingin menghapus pengumuman ini?');">
                                        Hapus
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="card-header bg-warning text-black text-center">
                            <strong>Tidak ada pengumuman terbaru untuk mata kuliah ini.</strong>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="modal fade" id="formPengumuman" tabindex="-1" aria-labelledby="formPengumumanLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-black text-white">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="formPengumumanLabel">Input Pengumuman</h1>
                            <button type="button" class="btn-close btn-warning small" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="<?= BASEURL; ?>/akademik/tambahPengumumanForm" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="id_jadwal" 
                                value="<?= $data['detail_mk']['id_jadwal']; ?>">
                                <input type="hidden" name="id_pengumuman" id="id_pengumuman">
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul Pengumuman</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                                <div class="mb-3">
                                    <label for="isi_pengumuman" class="form-label">Isi Pengumuman</label>
                                    <textarea class="form-control" id="isi_pengumuman" name="isi_pengumuman" rows="5" required></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-warning text-black" style="font-weight: 600;"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            