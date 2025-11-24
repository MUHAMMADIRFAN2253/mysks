<?php

class Akademik_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllPerkuliahan()
    {
        $query = "SELECT perkuliahan.*, dosen.nama_dosen 
                  FROM perkuliahan perkuliahan
                  LEFT JOIN dosen dosen ON perkuliahan.nip_dosen = dosen.nip
                  ORDER BY perkuliahan.hari_jam";

        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getAllPerwalian()
    {
        $query = "SELECT mahasiswa.nim, mahasiswa.nama_mahasiswa, mahasiswa.nip_pa, dosen.nama_dosen, 
                  mahasiswa.kelas_tahun_akademik AS kelas_tahun, 
                  mahasiswa.status_akademik AS status 
                  FROM mahasiswa mahasiswa
                  LEFT JOIN dosen dosen ON mahasiswa.nip_pa = dosen.nip
                  ORDER BY mahasiswa.kode_kelas, mahasiswa.nim";

        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function getAllPenelitian()
    {
        $this->db->query('SELECT * FROM penelitian
        ORDER BY penelitian.no ASC');

        return $this->db->resultSet();
    }

    public function getAllPengabdian()
    {
        $this->db->query('SELECT * FROM pengabdian
        ORDER BY pengabdian.no ASC');

        return $this->db->resultSet();
    }

    public function tambahDataPengabdian($data)
    {
        $query = "INSERT INTO pengabdian 
                  (nip, nama_dosen, judul_pengabdian, aktivitas)
                  VALUES
                  (:nip, :nama_dosen, :judul_pengabdian, :aktivitas)";

        $this->db->query($query);
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('nama_dosen', $data['nama_dosen']);
        $this->db->bind('judul_pengabdian', $data['judul_pengabdian']);
        $this->db->bind('aktivitas', $data['aktivitas']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function tambahDataPenelitian($data)
    {
        $query = "INSERT INTO penelitian 
                  (nip, nama_dosen, judul_penelitian, aktivitas)
                  VALUES
                  (:nip, :nama_dosen, :judul_penelitian, :aktivitas)";

        $this->db->query($query);
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('nama_dosen', $data['nama_dosen']);
        $this->db->bind('judul_penelitian', $data['judul_penelitian']);
        $this->db->bind('aktivitas', $data['aktivitas']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getPengabdianByNo($no)
    {
        $query = "SELECT * FROM pengabdian WHERE no = :no";

        $this->db->query($query);
        $this->db->bind('no', $no);

        return $this->db->single();
    }

    public function hapusDataPengabdian($no)
    {
        $query = "DELETE FROM pengabdian WHERE no = :no";

        $this->db->query($query);
        $this->db->bind('no', $no);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getPenelitianByNo($no)
    {
        $query = "SELECT * FROM penelitian WHERE no = :no";

        $this->db->query($query);
        $this->db->bind('no', $no);

        return $this->db->single();
    }

    public function hapusDataPenelitian($no)
    {
        $query = "DELETE FROM penelitian WHERE no = :no";

        $this->db->query($query);
        $this->db->bind('no', $no);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataPengabdian($data)
    {
        $query = "UPDATE pengabdian SET
                  nip = :nip,
                  nama_dosen = :nama_dosen,
                  judul_pengabdian = :judul_pengabdian,
                  aktivitas = :aktivitas
                  WHERE no = :no";

        $this->db->query($query);
        $this->db->bind('no', $data['no']);
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('nama_dosen', $data['nama_dosen']);
        $this->db->bind('judul_pengabdian', $data['judul_pengabdian']);
        $this->db->bind('aktivitas', $data['aktivitas']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataPenelitian($data)
    {
        $query = "UPDATE penelitian SET
                  nip = :nip,
                  nama_dosen = :nama_dosen,
                  judul_penelitian = :judul_penelitian,
                  aktivitas = :aktivitas
                  WHERE no = :no";

        $this->db->query($query);
        $this->db->bind('no', $data['no']);
        $this->db->bind('nip', $data['nip']);
        $this->db->bind('nama_dosen', $data['nama_dosen']);
        $this->db->bind('judul_penelitian', $data['judul_penelitian']);
        $this->db->bind('aktivitas', $data['aktivitas']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
