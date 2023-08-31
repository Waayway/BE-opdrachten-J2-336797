<?php

class VoertuigenModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllVehiclesAndCategory()
    {
        $sql =
            "SELECT vt.id,vt.kenteken, vt.type, vt.bouwjaar, vt.brandstof, tv.typevoertuig, tv.rijbewijscategorie
            FROM voertuig vt
            INNER JOIN typevoertuig tv on vt.typevoertuigID = tv.id";

        $this->db->query($sql);

        return $this->db->resultSet();
    }

    public function getVehicleById(int $id)
    {
        $sql = "SELECT v.id, vi.instructeurID, v.kenteken, v.type, v.bouwjaar, v.brandstof, vt.typevoertuig, vt.rijbewijscategorie FROM voertuig v
                INNER JOIN typevoertuig vt ON vt.id = v.typevoertuigID
                INNER JOIN voertuiginstructeur vi ON vi.voertuigID = v.id
                WHERE v.id = :id";

        $this->db->query($sql);
        $this->db->bindValue(":id", $id);
        return $this->db->result();
    }
    public function getAllVehicleCategories() {
        $sql = "SELECT * FROM typevoertuig";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    
    public function updateVehicle(int $id, string $instructeur, string $typevoertuig, string $type, string $bouwjaar, string $brandstof, string $kenteken) {
        
    }
}
