<div class="container-fluid py-5 text-center">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            
            <h1 class="display-4 text-warning mb-4">🚧 Mohon Maaf 🚧</h1>
            
            <div class="card bg-dark text-white shadow p-5">
                <h2 class="h3">Fitur Ini Masih dalam Tahap Pengembangan (Development)</h2>
                <p class="lead mt-3">
                    Kami sedang berupaya keras untuk menyelesaikan fitur ini secepatnya. 
                    Mohon kesabarannya dan silakan kembali lagi nanti.
                </p>
                
                <?php if ($data['halaman_asal'] === 'index') {
                    $url_kembali = BASEURL . '/Akademik';
                    $teks_tombol = 'Kembali ke Beranda';
                } else {
                    $url_kembali = BASEURL . '/Akademik/' . $data['halaman_asal'];
                    $teks_tombol = 'Kembali ke Halaman ' . ucfirst($data['halaman_asal']);
                }
                ?>

                <?php if (($data['role'] === 'admin') || ($data['role'] === 'dosen')): ?>
                    <a href="<?= $url_kembali; ?>" class="btn btn-warning mt-4 text-black font-weight-bold">
                        <?= $teks_tombol; ?>
                    </a>
                <?php else: ?>
                    <a href="<?= BASEURL; ?>/Akademik" class="btn btn-warning mt-4 text-black font-weight-bold">
                        Kembali ke Beranda
                    </a>
                <?php endif; ?>

            </div>
            
        </div>
    </div>
</div>
