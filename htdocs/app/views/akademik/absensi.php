                <div class="bg-black">
                    <?php if ($data['role'] === 'dosen'): ?>
                        <h1 class="h3 my-4">Input & Verifikasi Absensi</h1>
                    <?php endif; ?>
                    <?php if ($data['role'] === 'mahasiswa'): ?>
                        <h1 class="h3 my-4">Detail Absensi</h1>
                    <?php endif; ?>
                    <div class="card mb-4 bg-dark text-white shadow">
                        <?php Flasher::flash('Absensi'); ?>
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
                        <a href="#" class="btn btn-info text-black mb-4 tampilModalTambahAbsensi" data-bs-toggle="modal" data-bs-target="#formAbsensi"> <strong>Input Absensi</strong> </a>
                    <?php endif; ?>
                    <table class="table table-responsive table-striped table-sm table-info">
                        <thead>
                            <tr>
                                <th>Pertemuan</th>
                                <th>Tanggal</th>
                                <th>NIM Mahasiswa</th>
                                <th>Nama Mahasiswa</th>
                                <th>Status Kehadiran</th>
                                <th>Keterangan</th>
                                <?php if ($data['role'] === 'dosen'): ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['absensi'])): ?>
                                <?php foreach ($data['absensi'] as $absensi): ?>
                                    <tr>
                                        <td><?= $absensi['pertemuan_ke']; ?></td>
                                        <td><?= $absensi['tanggal_absensi']; ?></td>
                                        <td><?= $absensi['nim_mahasiswa']; ?></td>
                                        <td><?= $absensi['nama_mahasiswa']; ?></td> 
                                        <td>
                                            <span class="badge 
                                                <?php
                                                if ($absensi['status_kehadiran'] == 'Hadir') {
                                                    echo 'badge-success text-black';
                                                } elseif ($absensi['status_kehadiran'] == 'Alpha') {
                                                    echo 'badge-danger text-black';
                                                } else {
                                                    echo 'badge-warning text-black';
                                                }
                                                ?>
                                                ">
                                                <?= $absensi['status_kehadiran']; ?>
                                            </span>
                                        </td>
                                        <td><?= $absensi['keterangan']; ?></td>
                                        <?php if ($data['role'] === 'dosen'): ?>
                                            <td>
                                                <a href="<?= BASEURL; ?>/akademik/ubahAbsensi/<?= $absensi['id_absensi']; ?>/" class="badge badge-primary tampilModalUbahAbsensi" data-bs-toggle="modal" data-bs-target="#formAbsensi" 
                                                data-id_absensi="<?= $absensi['id_absensi']; ?>">Edit</a>

                                                <a href="<?= BASEURL; ?>/Akademik/hapusAbsensi/<?= $absensi['id_absensi']; ?>/" class="badge badge-danger" 
                                                onclick="return confirm('Yakin ingin menghapus absensi NIM <?= htmlspecialchars($absensi['nim_mahasiswa'], ENT_QUOTES, 'UTF-8'); ?> pada pertemuan ke-<?= $absensi['pertemuan_ke']; ?>?');">Hapus</a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data absensi untuk jadwal ini.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal fade" id="formAbsensi" tabindex="-1" aria-labelledby="formAbsensiLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-black text-white">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="formAbsensiLabel">Input Absensi</h1>
                            <button type="button" class="btn-close btn-info small" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="<?= BASEURL; ?>/akademik/tambahAbsensiForm" method="post">
                            <div class="modal-body">
                                <input type="hidden" name="id_jadwal" 
                                value="<?= $data['detail_mk']['id_jadwal']; ?>">
                                <input type="hidden" name="id_absensi" id="id_absensi">
                                <div class="mb-3">
                                    <label for="nim_mahasiswa" class="form-label">NIM - Nama Mahasiswa</label>
                                    <select class="form-control" id="nim_mahasiswa" name="nim_mahasiswa" required>
                                        <option value="" disabled selected>-- Pilih Mahasiswa --</option>
                                        <?php foreach ($data['mahasiswa_kelas'] as $mhs): ?>
                                            <option value="<?= $mhs['nim']; ?>">
                                                <?= $mhs['nim']; ?> - <?= $mhs['nama_mahasiswa']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="pertemuan_ke" class="form-label">Pertemuan</label>
                                    <input type="number" class="form-control" id="pertemuan_ke" 
                                    name="pertemuan_ke" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_absensi" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal_absensi" name="tanggal_absensi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status_kehadiran" class="form-label">Status Kehadiran</label>
                                    <select class="form-control" id="status_kehadiran" 
                                    name="status_kehadiran" required>
                                        <?php foreach ($data['status_kehadiran_enum'] as $status): ?>
                                            <option value="<?= $status; ?>"><?= $status; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="keterangan" class="form-label">Keterangan</label>
                                    <input type="text" class="form-control" id="keterangan" name="keterangan">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                    Batal
                                </button>
                                <button type="submit" class="btn btn-info text-black" style="font-weight: 600;"></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            