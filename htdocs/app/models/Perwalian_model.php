<?php

class Perwalian_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getMahasiswaBimbinganByNIP($nip_dosen)
    {
        $query = "SELECT nim, nip_pa, nama_mahasiswa, 
                  kelas_tahun_akademik AS kelas_tahun, 
                  status_akademik AS status 
                  FROM mahasiswa 
                  WHERE nip_pa = :nip_dosen
                  ORDER BY kode_kelas, nim";

        $this->db->query($query);
        $this->db->bind('nip_dosen', $nip_dosen);

        return $this->db->resultSet();
    }

    public function getDetailPerwalianByNIM($nim_mahasiswa)
    {
        $query = "SELECT mahasiswa.*, dosen.nip AS nip_pa, dosen.nama_dosen
                  FROM mahasiswa mahasiswa
                  JOIN dosen dosen ON mahasiswa.nip_pa = dosen.nip
                  WHERE mahasiswa.nim = :nim_mahasiswa";

        $this->db->query($query);
        $this->db->bind('nim_mahasiswa', $nim_mahasiswa);

        return $this->db->single();
    }
}
