<?php

class Dosen_model
{
    private $table = 'dosen';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getNamaDosenByNIP($nip_dosen)
    {
        $query = "SELECT nama_dosen FROM " . $this->table . " 
                  WHERE nip = :nip_dosen";

        $this->db->query($query);
        $this->db->bind('nip_dosen', $nip_dosen);

        $result = $this->db->single();

        if ($result) {
            return $result['nama_dosen'];
        }

        return null;
    }
}
