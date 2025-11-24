                <div class="bg-black">
                    <h1 class="h3 text-info my-4">Perkuliahan</h1>
                    <?php if ($data['role'] === 'admin'): ?>
                        <button type="button" class="btn btn-info tombolTambahJadwal" data-bs-toggle="modal" data-bs-target="#tambahJadwalModal" onclick="window.location.href='<?= BASEURL; ?>/Akademik/development/perkuliahan'">
                            Kelola Jadwal Kuliah
                        </button>
                    <?php endif; ?>
                    <table class="table table-responsive table-striped table-sm table-info">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Hari & Jam</th>
                                <th scope="col">Ruangan</th>
                                <th scope="col">Kode & Mata Kuliah</th>
                                <?php if ($data['role'] === 'admin'): ?>
                                    <th scope="col">Dosen Pengampu</th>
                                <?php endif; ?>
                                <th scope="col">SKS Penjadwalan</th>
                                <th scope="col">Kelas & Kode Kelas</th>
                                <th scope="col">Jenis Perkuliahan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['perkuliahan'])): ?>
                                <?php $no = 1; ?>
                                <?php foreach ($data['perkuliahan'] as $perkuliahan): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $perkuliahan['hari_jam']; ?></td>
                                        <td><?= $perkuliahan['ruangan']; ?></td>
                                        <td><?= $perkuliahan['kode_nama_mata_kuliah']; ?></td>
                                        <?php if ($data['role'] === 'admin'): ?>
                                            <td><?= $perkuliahan['nama_dosen']; ?></td>
                                        <?php endif; ?>
                                        <td><?= $perkuliahan['sks']; ?></td>
                                        <td><?= $perkuliahan['nama_kelas_kode_kelas']; ?></td>
                                        <td><?= $perkuliahan['jenis_perkuliahan']; ?></td>
                                        <td>
                                            <?php if (($data['role'] === 'dosen') || ($data['role'] === 'mahasiswa')): ?>
                                                <a href="<?= BASEURL; ?>/Akademik/absensi/<?= $perkuliahan['id_jadwal']; ?>" class="btn btn-info">Lihat Absensi</a>
                                                <a href="<?= BASEURL; ?>/Akademik/pengumuman/<?= $perkuliahan['id_jadwal']; ?>" class="btn btn-info">Lihat Pengumuman</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data perkuliahan.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            