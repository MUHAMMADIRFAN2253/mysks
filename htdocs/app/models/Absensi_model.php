<?php

class Absensi_model
{
    private $table = 'absensi';
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

    public function getAbsensiByJadwal($id_jadwal)
    {
        $query = "SELECT absensi.*, mahasiswa.nama_mahasiswa 
                  FROM " . $this->table . " absensi
                  JOIN mahasiswa mahasiswa ON absensi.nim_mahasiswa = mahasiswa.nim
                  WHERE absensi.id_jadwal = :id_jadwal
                  ORDER BY absensi.pertemuan_ke, mahasiswa.nim";

        $this->db->query($query);
        $this->db->bind('id_jadwal', $id_jadwal);

        return $this->db->resultSet();
    }

    public function getAbsensiByJadwalDanNIM($id_jadwal, $nim_mahasiswa)
    {
        $query = "SELECT absensi.*, mahasiswa.nama_mahasiswa 
                  FROM " . $this->table . " absensi
                  JOIN mahasiswa mahasiswa ON absensi.nim_mahasiswa = mahasiswa.nim
                  WHERE absensi.id_jadwal = :id_jadwal 
                  AND absensi.nim_mahasiswa = :nim_mahasiswa
                  ORDER BY absensi.pertemuan_ke";

        $this->db->query($query);
        $this->db->bind('id_jadwal', $id_jadwal);
        $this->db->bind('nim_mahasiswa', $nim_mahasiswa);

        return $this->db->resultSet();
    }

    public function getMahasiswaByJadwal($id_jadwal)
    {
        $query = "SELECT mahasiswa.nim, mahasiswa.nama_mahasiswa 
                  FROM mahasiswa mahasiswa
                  JOIN krs krs ON mahasiswa.nim = krs.nim
                  WHERE krs.id_jadwal = :id_jadwal
                  ORDER BY mahasiswa.nim";

        $this->db->query($query);
        $this->db->bind('id_jadwal', $id_jadwal);

        return $this->db->resultSet();
    }

    public function getEnumValues($table, $column)
    {
        $query = "SHOW COLUMNS FROM $table LIKE :column";

        $this->db->query($query);
        $this->db->bind('column', $column);

        $row = $this->db->single();

        preg_match("/^enum\('(.*)'\)$/", $row['Type'], $matches);

        $values = explode("','", $matches[1]);

        return $values;
    }

    public function tambahAbsensi($data)
    {
        $query = "INSERT INTO " . $this->table . " 
                  (id_jadwal, nim_mahasiswa, pertemuan_ke, tanggal_absensi, waktu_masuk, status_kehadiran, keterangan)
                  VALUES
                  (:id_jadwal, :nim_mahasiswa, :pertemuan_ke, :tanggal_absensi, :waktu_masuk, :status_kehadiran, :keterangan)";

        $this->db->query($query);
        $this->db->bind('id_jadwal', $data['id_jadwal']);
        $this->db->bind('nim_mahasiswa', $data['nim_mahasiswa']);
        $this->db->bind('pertemuan_ke', $data['pertemuan_ke']);
        $this->db->bind('tanggal_absensi', $data['tanggal_absensi']);
        $this->db->bind('waktu_masuk', date('H:i:s'));
        $this->db->bind('status_kehadiran', $data['status_kehadiran']);
        $this->db->bind('keterangan', $data['keterangan']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAbsensiById($id_absensi)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id_absensi = :id_absensi";

        $this->db->query($query);
        $this->db->bind('id_absensi', $id_absensi);

        return $this->db->single();
    }

    public function hapusAbsensi($id_absensi)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id_absensi = :id_absensi";

        $this->db->query($query);
        $this->db->bind('id_absensi', $id_absensi);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahAbsensi($data)
    {
        $query = "UPDATE " . $this->table . " SET 
                  nim_mahasiswa = :nim_mahasiswa,
                  pertemuan_ke = :pertemuan_ke,
                  tanggal_absensi = :tanggal_absensi,
                  status_kehadiran = :status_kehadiran,
                  keterangan = :keterangan
                  WHERE id_absensi = :id_absensi";

        $this->db->query($query);
        $this->db->bind('nim_mahasiswa', $data['nim_mahasiswa']);
        $this->db->bind('pertemuan_ke', $data['pertemuan_ke']);
        $this->db->bind('tanggal_absensi', $data['tanggal_absensi']);
        $this->db->bind('status_kehadiran', $data['status_kehadiran']);
        $this->db->bind('keterangan', $data['keterangan']);
        $this->db->bind('id_absensi', $data['id_absensi']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
