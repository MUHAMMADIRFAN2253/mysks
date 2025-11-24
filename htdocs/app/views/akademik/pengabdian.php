                <div class="bg-black">
                    <?php Flasher::flash('Pengabdian'); ?>
                    <h1 class="h3 text-info my-4">Pengabdian</h1>
                    <?php if (($data['role'] === 'admin') || ($data['role'] === 'dosen')): ?>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <button type="button" class="btn btn-info tombolTambahData" data-bs-toggle="modal" data-bs-target="#tambahDataPengabdian">
                                    Tambah Data Pengabdian
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                    <table class="table table-responsive table-striped table-sm table-info">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nip</th>
                                <th scope="col">Nama Dosen</th>
                                <th scope="col">Judul Pengabdian</th>
                                <th scope="col">Aktivitas</th>
                                <?php if (($data['role'] === 'admin') || ($data['role'] === 'dosen')): ?>
                                    <th>Aksi</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($data['pengabdian'])): ?>
                                <?php $no = 1; ?>
                                <?php foreach ($data['pengabdian'] as $pengabdian): ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $pengabdian['nip']; ?></td>
                                        <td><?= $pengabdian['nama_dosen']; ?></td>
                                        <td><?= $pengabdian['judul_pengabdian']; ?></td>
                                        <td><?= $pengabdian['aktivitas']; ?></td>
                                        <td>
                                            <?php if ($data['role'] === 'admin'): ?>
                                                <a href="<?= BASEURL; ?>/Akademik/getUbahPengabdian/<?= $pengabdian['no']; ?>" class="badge badge-primary tombolUbahPengabdian" data-bs-toggle="modal" data-bs-target="#tambahDataPengabdian" data-id="<?= $pengabdian['no']; ?>">Edit</a>

                                                <a href="<?= BASEURL; ?>/Akademik/hapusPengabdian/<?= $pengabdian['no']; ?>" class="badge badge-danger" data-aksi="hapus">Hapus</a>
                                            <?php endif; ?>

                                            <?php if ($data['role'] === 'dosen'): ?>
                                                <a href="<?= BASEURL; ?>/Akademik/getUbahPengabdian/<?= $pengabdian['no']; ?>" class="badge badge-primary tombolUbahPengabdian" data-bs-toggle="modal" data-bs-target="#tambahDataPengabdian" data-id="<?= $pengabdian['no']; ?>">Edit</a>

                                                <a href="<?= BASEURL; ?>/Akademik/hapusPengabdian/<?= $pengabdian['no']; ?>" class="badge badge-danger" onclick="return confirm('Yakin ingin menghapus data ini?');">Hapus</a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3">Belum ada data pengabdian.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <div class="modal fade" id="tambahDataPengabdian" tabindex="-1" aria-labelledby="judulModal" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5 text-black" id="judulModal">
                                        Tambah Data Pengabdian
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="<?=BASEURL;?>/akademik/tambahPengabdian/" method="post">
                                        <input type="hidden" name="no" id="no">
                                        <?php if ($data['role'] === 'admin'): ?>
                                            <div class="form-group">
                                                <label for="nip" class="form-label text-black">Nip</label>
                                                <input type="text" class="form-control text-black" id="nip" name="nip">
                                            </div>
                                            <div class="form-group">
                                                <label for="nama_dosen" class="form-label text-black">Nama Dosen</label>
                                                <input type="text" class="form-control text-black" id="nama_dosen" name="nama_dosen">
                                            </div>
                                        <?php endif; ?>
                                        <div class="form-group">
                                            <label for="judul_pengabdian" class="form-label text-black">Judul Pengabdian</label>
                                            <textarea class="form-control text-black" id="judul_pengabdian" name="judul_pengabdian" rows="3"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="aktivitas" class="form-label text-black">Aktivitas</label>
                                            <textarea class="form-control text-black" id="aktivitas" name="aktivitas" rows="3"></textarea>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-info">Tambah Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            