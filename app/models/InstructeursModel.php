<?php

class InstructeursModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getInstructeurs()
    {
        $sql = "SELECT * FROM instructeurs ins ORDER BY ins.aantalSterren DESC";

        $this->db->query($sql);

        return $this->db->resultSet();
    }

    public function countInstructeurs()
    {
        $sql = "SELECT COUNT(*) as count FROM instructeurs";

        $this->db->query($sql);
        $result = $this->db->result();
        return $result->count;
    }

    public function getInstructeur($id)
    {
        $sql = "SELECT * FROM instructeurs ins WHERE ins.id = :id";

        $this->db->query($sql);
        $this->db->bindValue(":id", $id);
        return $this->db->result();
    }

    public function getVoertuigenOf($id)
    {
        $sql = "SELECT v.id, v.kenteken, v.type, v.bouwjaar, v.brandstof, vt.typevoertuig, vt.rijbewijscategorie, 
                (
                    SELECT COUNT(*) 
                    FROM voertuiginstructeur vi
                    INNER JOIN instructeurs ins ON ins.id = vi.instructeurID
                    WHERE vi.voertuigID = v.id AND ins.isActive = 1
                ) AS toegewezenAantal
                FROM voertuiginstructeur vi 
                INNER JOIN voertuig v ON v.id = vi.voertuigID
                INNER JOIN typevoertuig vt ON vt.id = v.typevoertuigID
                WHERE vi.instructeurID = :id AND
                (SELECT isActive FROM instructeurs ins WHERE ins.id = vi.instructeurID) = 1
                ORDER BY vt.rijbewijscategorie ASC;";
        $this->db->query($sql);
        $this->db->bindValue(":id", $id);
        return $this->db->resultSet();
    }

    public function bindVoertuigToInstructeur($voertuigID, $instructeurID)
    {
        $sql =
            "INSERT INTO voertuiginstructeur (voertuigID, instructeurID, datumToekenning)
            VALUES (:vId, :iId, sysdate())";
        $this->db->query($sql);
        $this->db->bindValue(":vId", $voertuigID);
        $this->db->bindValue(":iId", $instructeurID);
        $this->db->execute();
    }
    public function checkIfVoertuigAlreadyBound($voertuigID, $instructeurID)
    {
        $sql = "SELECT COUNT(*) as num
                FROM voertuiginstructeur
                WHERE voertuigID = :vId AND instructeurID = :iId";

        $this->db->query($sql);
        $this->db->bindValue(":vId", $voertuigID);
        $this->db->bindValue(":iId", $instructeurID);
        $res = $this->db->result();
        return $res->num > 0;
    }
    public function getInstructeurFromVoertuigId(int $id) {
        $sql = "SELECT ins.id, ins.voornaam, ins.tussenvoegsel, ins.achternaam, ins.datumInDienst, ins.aantalSterren FROM instructeurs ins
                INNER JOIN voertuiginstructeur vi ON vi.instructeurID = ins.id
                WHERE vi.voertuigID = :id";
        $this->db->query($sql);
        $this->db->bindValue(":id", $id);
        return $this->db->result();
    }
    public function toggleInstructeurZiek(int $instructeurId) {
        $sql = "UPDATE instructeurs SET isActive = NOT isActive WHERE id = :id";
        $this->db->query($sql);
        $this->db->bindValue(":id", $instructeurId);
        $this->db->execute();
    }
}
