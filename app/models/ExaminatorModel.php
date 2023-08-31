<?php

class ExaminatorModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllExaminators()
    {
        $sql = "SELECT exa.voornaam,
                       exa.tussenvoegsel,
                       exa.achternaam,
                       ex.datum,
                       ex.rijbewijscategorie,
                       ex.rijschool,
                       ex.stad,
                       SUM(ex.uitslag) as uitslag, 
                       COUNT(*) as total
        FROM examenPerExaminator exp
        INNER JOIN examen ex ON ex.id = exp.examenId
        INNER JOIN examinator exa ON exa.id = exp.examinatorId
        GROUP BY exa.voornaam, exa.tussenvoegsel, exa.achternaam
        ORDER BY SUM(ex.uitslag) DESC;";

        $this->db->query($sql);

        return $this->db->resultSet();
    }
}
