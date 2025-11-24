<?php

class Akademik extends Controller
{
    public function index()
    {
        $data['judul'] = 'Sistem Informasi Akademik';

        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        $this->view('templates/akademik', $data);
        $this->view('akademik/index', $data);
        $this->view('templates/akademik_footer');
    }

    public function perkuliahan()
    {
        $data['judul'] = 'Perkuliahan';

        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        $akademikModel = $this->model('Akademik_model');
        $perkuliahanModel = $this->model('Perkuliahan_model');
        $id_pengguna = $_SESSION['user_id'];
        $data['role'] = $_SESSION['role'];

        if ($data['role'] === 'admin') {
            $data['perkuliahan'] = $akademikModel->getAllPerkuliahan();
        } elseif ($data['role'] === 'dosen') {
            $data['perkuliahan'] = $perkuliahanModel->getPerkuliahanByNIP($id_pengguna);
        } else {
            $data['perkuliahan'] = $perkuliahanModel->getPerkuliahanByNIM($id_pengguna);
        }

        $this->view('templates/akademik', $data);
        $this->view('akademik/perkuliahan', $data);
        $this->view('templates/akademik_footer');
    }

    public function perwalian()
    {
        $data['judul'] = 'Perwalian';

        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        $akademikModel = $this->model('Akademik_model');
        $perwalianModel = $this->model('Perwalian_model');
        $id_pengguna = $_SESSION['user_id'];
        $data['role'] = $_SESSION['role'];

        if ($data['role'] === 'admin') {
            $data['perwalian'] = $akademikModel->getAllPerwalian();

            $this->view('templates/akademik', $data);
            $this->view('akademik/perwalian', $data);
            $this->view('templates/akademik_footer');
        } elseif ($data['role'] === 'dosen') {
            $data['perwalian'] = $perwalianModel->getMahasiswaBimbinganByNIP($id_pengguna);

            $this->view('templates/akademik', $data);
            $this->view('akademik/perwalian', $data);
            $this->view('templates/akademik_footer');
        } else {
            $data['detail_perwalian'] = $perwalianModel->getDetailPerwalianByNIM($id_pengguna);

            $this->view('templates/akademik', $data);
            $this->view('akademik/perwalian_mahasiswa', $data);
            $this->view('templates/akademik_footer');
        }
    }

    public function pengabdian()
    {
        $data['judul'] = 'Pengabdian';

        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        $akademikModel = $this->model('Akademik_model');
        $pengabdianModel = $this->model('Pengabdian_model');
        $id_pengguna = $_SESSION['user_id'];
        $data['role'] = $_SESSION['role'];

        if ($data['role'] === 'admin') {
            $data['pengabdian'] = $akademikModel->getAllPengabdian();
        } elseif ($data['role'] === 'dosen') {
            $data['pengabdian'] = $pengabdianModel->getPengabdianByNIP($id_pengguna);
        } else {
            $data['pengabdian'] = $pengabdianModel->getAllPengabdian();
        }

        $this->view('templates/akademik', $data);
        $this->view('akademik/pengabdian', $data);
        $this->view('templates/akademik_footer');
    }

    public function tambahPengabdian()
    {
        $role = $_SESSION['role'];
        $data = $_POST;

        if ($role === 'dosen') {
            $nip_dosen = $_SESSION['user_id'];
            $nama_dosen = $this->model('Dosen_model')->getNamaDosenByNIP($nip_dosen);

            $data['nip'] = $nip_dosen;
            $data['nama_dosen'] = $nama_dosen;

        } elseif ($role === 'admin') {
            if (empty($data['nip']) || empty($data['nama_dosen'])) {
                Flasher::setFlash('gagal', ' ditambahkan. NIP dan Nama Dosen wajib diisi.', 'danger');
                header('Location: ' . BASEURL . '/Akademik/pengabdian/');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        if ($this->model('Akademik_model')->tambahDataPengabdian($data) > 0) {
            Flasher::setFlash('berhasil', ' ditambahkan', 'info');
        } else {
            Flasher::setFlash('gagal', ' ditambahkan', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/pengabdian/');
        exit;
    }

    public function hapusPengabdian($no)
    {
        $role = $_SESSION['role'];
        $nip_user = $_SESSION['user_id'];
        $akademikModel = $this->model('Akademik_model');

        if ($role === 'dosen') {
            $data_pengabdian = $akademikModel->getPengabdianByNo($no);
            if ($data_pengabdian['nip'] !== $nip_user) {
                Flasher::setFlash('gagal', ' dihapus. Anda tidak memiliki izin.', 'danger');
                header('Location: ' . BASEURL . '/Akademik/pengabdian/');
                exit;
            }
        }

        if ($akademikModel->hapusDataPengabdian($no) > 0) {
            Flasher::setFlash('berhasil', ' dihapus', 'info');
        } else {
            Flasher::setFlash('gagal', ' dihapus', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/pengabdian/');
        exit;
    }

    public function getUbahPengabdian()
    {
        $no = $_POST['no'];
        $data = $this->model('Akademik_model')->getPengabdianByNo($no);
        echo json_encode($data);
    }

    public function ubahPengabdian()
    {
        $role = $_SESSION['role'];
        $data = $_POST;

        if ($role === 'dosen') {
            $nip_dosen = $_SESSION['user_id'];
            $nama_dosen = $this->model('Dosen_model')->getNamaDosenByNIP($nip_dosen);

            $data['nip'] = $nip_dosen;
            $data['nama_dosen'] = $nama_dosen;
        }

        if ($this->model('Akademik_model')->ubahDataPengabdian($data) > 0) {
            Flasher::setFlash('berhasil', ' diubah', 'info');
        } else {
            Flasher::setFlash('gagal', ' diubah', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/pengabdian/');
        exit;
    }

    public function penelitian()
    {
        $data['judul'] = 'Penelitian';

        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        $akademikModel = $this->model('Akademik_model');
        $penelitianModel = $this->model('Penelitian_model');
        $id_pengguna = $_SESSION['user_id'];
        $data['role'] = $_SESSION['role'];

        if ($data['role'] === 'admin') {
            $data['penelitian'] = $akademikModel->getAllPenelitian();
        } elseif ($data['role'] === 'dosen') {
            $data['penelitian'] = $penelitianModel->getPenelitianByNIP($id_pengguna);
        } else {
            $data['penelitian'] = $penelitianModel->getAllPenelitian();
        }

        $this->view('templates/akademik', $data);
        $this->view('akademik/penelitian', $data);
        $this->view('templates/akademik_footer');
    }

    public function tambahPenelitian()
    {
        $role = $_SESSION['role'];
        $data = $_POST;

        if ($role === 'dosen') {
            $nip_dosen = $_SESSION['user_id'];
            $nama_dosen = $this->model('Dosen_model')->getNamaDosenByNIP($nip_dosen);

            $data['nip'] = $nip_dosen;
            $data['nama_dosen'] = $nama_dosen;

        } elseif ($role === 'admin') {
            if (empty($data['nip']) || empty($data['nama_dosen'])) {
                Flasher::setFlash('gagal', ' ditambahkan. NIP dan Nama Dosen wajib diisi.', 'danger');
                header('Location: ' . BASEURL . '/Akademik/penelitian/');
                exit;
            }
        } else {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        if ($this->model('Akademik_model')->tambahDataPenelitian($data) > 0) {
            Flasher::setFlash('berhasil', ' ditambahkan', 'info');
        } else {
            Flasher::setFlash('gagal', ' ditambahkan', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/penelitian/');
        exit;
    }

    public function hapusPenelitian($no)
    {
        $role = $_SESSION['role'];
        $nip_user = $_SESSION['user_id'];
        $akademikModel = $this->model('Akademik_model');

        if ($role === 'dosen') {
            $data_penelitian = $akademikModel->getPenelitianByNo($no);
            if ($data_penelitian['nip'] !== $nip_user) {
                Flasher::setFlash('gagal', ' dihapus. Anda tidak memiliki izin.', 'danger');
                header('Location: ' . BASEURL . '/Akademik/penelitian/');
                exit;
            }
        }

        if ($akademikModel->hapusDataPenelitian($no) > 0) {
            Flasher::setFlash('berhasil', ' dihapus', 'info');
        } else {
            Flasher::setFlash('gagal', ' dihapus', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/penelitian/');
        exit;
    }

    public function getUbahPenelitian()
    {
        $no = $_POST['no'];
        $data = $this->model('Akademik_model')->getPenelitianByNo($no);
        echo json_encode($data);
    }

    public function ubahPenelitian()
    {
        $role = $_SESSION['role'];
        $data = $_POST;

        if ($role === 'dosen') {
            $nip_dosen = $_SESSION['user_id'];
            $nama_dosen = $this->model('Dosen_model')->getNamaDosenByNIP($nip_dosen);

            $data['nip'] = $nip_dosen;
            $data['nama_dosen'] = $nama_dosen;
        }

        if ($this->model('Akademik_model')->ubahDataPenelitian($data) > 0) {
            Flasher::setFlash('berhasil', ' diubah', 'info');
        } else {
            Flasher::setFlash('gagal', ' diubah', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/penelitian/');
        exit;
    }

    public function absensi($id_jadwal)
    {
        $data['judul'] = 'Absensi Perkuliahan';

        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        $absensiModel = $this->model('Absensi_model');
        $data['detail_mk'] = $absensiModel->getJadwalById($id_jadwal);
        $data['status_kehadiran_enum'] = $absensiModel->getEnumValues('absensi', 'status_kehadiran');
        $data['role'] = $_SESSION['role'];

        if ($data['role'] === 'dosen') {
            $data['absensi'] = $absensiModel->getAbsensiByJadwal($id_jadwal);
            $data['mahasiswa_kelas'] = $absensiModel->getMahasiswaByJadwal($id_jadwal);
        } else {
            $nim_mahasiswa = $_SESSION['user_id'];
            $data['absensi'] = $absensiModel->getAbsensiByJadwalDanNIM($id_jadwal, $nim_mahasiswa);
        }

        $this->view('templates/akademik', $data);
        $this->view('akademik/absensi', $data);
        $this->view('templates/akademik_footer');
    }

    public function tambahAbsensiForm()
    {
        if ($this->model('Absensi_model')->tambahAbsensi($_POST)) {
            Flasher::setFlash('berhasil', ' ditambahkan', 'success');
        } else {
            Flasher::setFlash('gagal', ' ditambahkan', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/absensi/' . $_POST['id_jadwal']);
        exit;
    }

    public function hapusAbsensi($id_absensi)
    {
        $absensi = $this->model('Absensi_model')->getAbsensiById($id_absensi);

        if ($this->model('Absensi_model')->hapusAbsensi($id_absensi) > 0) {
            Flasher::setFlash('berhasil', ' dihapus', 'success');
        } else {
            Flasher::setFlash('gagal', ' dihapus', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/absensi/' . $absensi['id_jadwal']);
        exit;
    }

    public function getUbahAbsensi()
    {
        $id = $_POST['id_absensi'];
        $data = $this->model('Absensi_model')->getAbsensiById($id);
        echo json_encode($data);
    }

    public function ubahAbsensiForm()
    {
        if ($this->model('Absensi_model')->ubahAbsensi($_POST) > 0) {
            Flasher::setFlash('berhasil', ' diubah', 'success');
        } else {
            Flasher::setFlash('gagal', ' diubah', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/absensi/' . $_POST['id_jadwal']);
        exit;
    }

    public function pengumuman($id_jadwal)
    {
        $data['judul'] = 'Pengumuman Perkuliahan';

        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        $pengumumanModel = $this->model('Pengumuman_model');
        $data['pengumuman'] = $pengumumanModel->getPengumumanByJadwal($id_jadwal);
        $data['detail_mk'] = $pengumumanModel->getJadwalById($id_jadwal);
        $data['role'] = $_SESSION['role'];

        $this->view('templates/akademik', $data);
        $this->view('akademik/pengumuman', $data);
        $this->view('templates/akademik_footer');
    }

    public function tambahPengumumanForm()
    {
        $data = $_POST;
        $data['nip_dosen'] = $_SESSION['user_id'];

        if ($this->model('Pengumuman_model')->tambahPengumuman($data) > 0) {
            Flasher::setFlash('berhasil', ' ditambahkan', 'success');
        } else {
            Flasher::setFlash('gagal', ' ditambahkan', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/pengumuman/' . $_POST['id_jadwal']);
        exit;
    }

    public function hapusPengumuman($id_pengumuman)
    {
        $pengumuman = $this->model('Pengumuman_model')->getPengumumanById($id_pengumuman);
        $nip_dosen = $_SESSION['user_id'];

        if ($this->model('Pengumuman_model')->hapusPengumuman($id_pengumuman, $nip_dosen) > 0) {
            Flasher::setFlash('berhasil', ' dihapus', 'success');
        } else {
            Flasher::setFlash('gagal', ' dihapus', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/pengumuman/' . $pengumuman['id_jadwal']);
        exit;
    }

    public function getUbahPengumuman()
    {
        $id = $_POST['id_pengumuman'];
        $data = $this->model('Pengumuman_model')->getPengumumanById($id);
        echo json_encode($data);
    }

    public function ubahPengumumanForm()
    {
        $data = $_POST;
        $data['nip_dosen'] = $_SESSION['user_id'];

        if ($this->model('Pengumuman_model')->ubahPengumuman($data) > 0) {
            Flasher::setFlash('berhasil', ' diubah', 'success');
        } else {
            Flasher::setFlash('gagal', ' diubah', 'danger');
        }

        header('Location: ' . BASEURL . '/Akademik/pengumuman/' . $_POST['id_jadwal']);
        exit;
    }

    public function development($asal = 'index')
    {
        $data['judul'] = 'Dalam Pengembangan';

        if (!isset($_SESSION['is_login'])) {
            header('Location: ' . BASEURL . '/Auth');
            exit;
        }

        $data['role'] = $_SESSION['role'];
        $data['halaman_asal'] = $asal;

        $this->view('templates/akademik', $data);
        $this->view('akademik/development', $data);
        $this->view('templates/akademik_footer');
    }
}
