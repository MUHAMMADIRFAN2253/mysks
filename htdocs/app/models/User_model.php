<?php

class User_model
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUserByNIP($nip)
    {
        $query = 'SELECT nip, password, 
                  nama_dosen AS nama, 
                  "dosen" AS role 
                  FROM dosen 
                  WHERE nip = :id';

        $this->db->query($query);
        $this->db->bind('id', $nip);

        return $this->db->single();
    }

    public function getUserByNIM($nim)
    {
        $query = 'SELECT nim, password, 
                  nama_mahasiswa AS nama, 
                  "mahasiswa" AS role 
                  FROM mahasiswa 
                  WHERE nim = :id';

        $this->db->query($query);
        $this->db->bind('id', $nim);

        return $this->db->single();
    }
}
