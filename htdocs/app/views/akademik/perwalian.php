                <div class="bg-black">
                    <h1 class="h3 text-info my-4">Perwalian</h1>
                    <?php if ($data['role'] === 'admin'): ?>
                        <button type="button" class="btn btn-warning" onclick="window.location.href='<?= BASEURL; ?>/Akademik/development/perwalian'">Atur Dosen Wali Mahasiswa</button>
                        <button type="button" class="btn btn-danger" onclick="window.location.href='<?= BASEURL; ?>/Akademik/development/perwalian'">Buka/Tutup Periode KRS</button>
                    <?php endif; ?>
                    <table class="table table-responsive table-striped table-sm table-info">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">NIM</th>
                                <th scope="col">Nama</th>
                                <?php if ($data['role'] === 'admin'): ?>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Dosen Wali</th>
                                <?php endif; ?>
                                <th scope="col">Kelas/Tahun</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['perwalian'])): ?>
                                <?php $no = 1; ?>
                                <?php foreach ($data['perwalian'] as $perwalian): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $perwalian['nim']; ?></td>
                                        <td><?= $perwalian['nama_mahasiswa']; ?></td>
                                        <?php if ($data['role'] === 'admin'): ?>
                                            <td><?= $perwalian['nip_pa']; ?></td>
                                            <td><?= $perwalian['nama_dosen']; ?></td>
                                        <?php endif; ?>
                                        <td><?= $perwalian['kelas_tahun']; ?></td>
                                        <td><?= $perwalian['status']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">
                                        Belum ada data perwalian.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            