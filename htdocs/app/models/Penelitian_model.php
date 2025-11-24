<?php

class Penelitian_model
{
    private $table = 'penelitian';
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getPenelitianByNIP($nip_dosen)
    {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE nip = :nip_dosen 
                  ORDER BY nip DESC";

        $this->db->query($query);
        $this->db->bind('nip_dosen', $nip_dosen);

        return $this->db->resultSet();
    }

    public function getAllPenelitian()
    {
        $query = "SELECT * FROM " . $this->table . " 
                  ORDER BY nip DESC LIMIT 10";

        $this->db->query($query);

        return $this->db->resultSet();
    }
}
