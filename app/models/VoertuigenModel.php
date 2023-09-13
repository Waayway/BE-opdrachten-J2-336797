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
            "SELECT vt.id, vt.kenteken, vt.type, vt.bouwjaar, vt.brandstof, tv.typevoertuig, tv.rijbewijscategorie
            FROM voertuig vt
            INNER JOIN typevoertuig tv on vt.typevoertuigID = tv.id
            LEFT JOIN voertuiginstructeur vi on vt.id = vi.voertuigID
            WHERE vi.voertuigID IS NULL;
            ";

        $this->db->query($sql);

        return $this->db->resultSet();
    }

    public function getVehicleById(int $id)
    {
        $sql = "SELECT v.id, vi.instructeurID, v.kenteken, v.type, v.bouwjaar, v.brandstof, vt.typevoertuig, vt.rijbewijscategorie, v.typevoertuigID FROM voertuig v
                INNER JOIN typevoertuig vt ON vt.id = v.typevoertuigID
                INNER JOIN voertuiginstructeur vi ON vi.voertuigID = v.id
                WHERE v.id = :id";

        $this->db->query($sql);
        $this->db->bindValue(":id", $id);
        return $this->db->result();
    }
    public function getAllVehicleCategories()
    {
        $sql = "SELECT * FROM typevoertuig";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function updateVehicle(int $id, int $instructeur, string $typevoertuig, string $type, string $bouwjaar, string $brandstof, string $kenteken)
    {
        $sql = "UPDATE voertuig SET 
        type = :type,
        typevoertuigID = :typevoertuig,
        bouwjaar = :bouwjaar,
        brandstof = :brandstof,
        kenteken = :kenteken 
        WHERE id = :id";
        $this->db->query($sql);

        $this->db->bindValue(":typevoertuig", $typevoertuig);
        $this->db->bindValue(":type", $type);
        $this->db->bindValue(":bouwjaar", $bouwjaar);
        $this->db->bindValue(":brandstof", ucfirst($brandstof));
        $this->db->bindValue(":kenteken", $kenteken);
        $this->db->bindValue(":id", $id);

        $this->db->execute();

        $sql = "UPDATE voertuiginstructeur SET 
        instructeurID = :instructeur 
        WHERE voertuigID = :id";
        $this->db->query($sql);
        $this->db->bindValue(":instructeur", $instructeur);
        $this->db->bindValue(":id", $id);
        $this->db->execute();
    }
}
