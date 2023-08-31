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
        $sql = "SELECT v.id, v.kenteken, v.type, v.bouwjaar, v.brandstof, vt.typevoertuig, vt.rijbewijscategorie FROM voertuiginstructeur vi 
                INNER JOIN voertuig v ON v.id = vi.voertuigID
                INNER JOIN typevoertuig vt ON vt.id = v.typevoertuigID
                WHERE vi.instructeurID = :id
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
}
