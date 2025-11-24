<?php

class Perkuliahan_model
{
    private $table = 'perkuliahan';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPerkuliahanByNIP($nip_dosen)
    {
        $query = "SELECT * FROM " . $this->table . "
                  WHERE nip_dosen = :nip_dosen
                  ORDER BY hari_jam";

        $this->db->query($query);
        $this->db->bind('nip_dosen', $nip_dosen);

        return $this->db->resultSet();
    }

    public function getPerkuliahanByNIM($nim)
    {
        $query = "SELECT perkuliahan.* FROM " . $this->table . " perkuliahan
                  JOIN krs krs ON perkuliahan.id_jadwal = krs.id_jadwal
                  WHERE krs.nim = :nim
                  ORDER BY perkuliahan.hari_jam";

        $this->db->query($query);
        $this->db->bind('nim', $nim);

        return $this->db->resultSet();
    }
}
