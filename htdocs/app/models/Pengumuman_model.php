<?php

class Pengumuman_model
{
    private $table = 'pengumuman';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getJadwalById($id_jadwal)
    {
        $query = "SELECT * FROM perkuliahan WHERE id_jadwal = :id_jadwal";

        $this->db->query($query);
        $this->db->bind('id_jadwal', $id_jadwal);

        return $this->db->single();
    }

    public function getPengumumanByJadwal($id_jadwal)
    {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE id_jadwal = :id_jadwal
                  ORDER BY tanggal_dibuat DESC";

        $this->db->query($query);
        $this->db->bind('id_jadwal', $id_jadwal);

        return $this->db->resultSet();
    }

    public function tambahPengumuman($data)
    {
        $query = "INSERT INTO " . $this->table . " 
                  (id_jadwal, nip_dosen, judul, isi_pengumuman, tanggal_dibuat)
                  VALUES 
                  (:id_jadwal, :nip_dosen, :judul, :isi_pengumuman, :tanggal_dibuat)";

        $this->db->query($query);
        $this->db->bind('id_jadwal', $data['id_jadwal']);
        $this->db->bind('nip_dosen', $data['nip_dosen']);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('isi_pengumuman', $data['isi_pengumuman']);
        $this->db->bind('tanggal_dibuat', date('Y-m-d H:i:s'));

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getPengumumanById($id_pengumuman)
    {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE id_pengumuman = :id_pengumuman";

        $this->db->query($query);
        $this->db->bind('id_pengumuman', $id_pengumuman);

        return $this->db->single();
    }

    public function hapusPengumuman($id_pengumuman, $nip_dosen)
    {
        $query = "DELETE FROM " . $this->table . " 
                  WHERE id_pengumuman = :id_pengumuman
                  AND nip_dosen = :nip_dosen";

        $this->db->query($query);
        $this->db->bind('id_pengumuman', $id_pengumuman);
        $this->db->bind('nip_dosen', $nip_dosen);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahPengumuman($data)
    {
        $query = "UPDATE " . $this->table . " SET 
                  judul = :judul, 
                  isi_pengumuman = :isi_pengumuman 
                  WHERE id_pengumuman = :id_pengumuman
                  AND nip_dosen = :nip_dosen";

        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('isi_pengumuman', $data['isi_pengumuman']);
        $this->db->bind('id_pengumuman', $data['id_pengumuman']);
        $this->db->bind('nip_dosen', $data['nip_dosen']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
