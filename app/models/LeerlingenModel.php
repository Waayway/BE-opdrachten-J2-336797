<?php

class LeerlingenModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAllLeerlingenAndLesPakketten()
    {
        $sql = "SELECT  ll.voornaam, 
                        ll.tussenvoegsel, 
                        ll.achternaam, 
                        ll.mobiel, 
                        lp.naam as pakketnaam, 
                        lp.aantalLessen, 
                        lp.prijs, 
                        lpl.startdatumrijlessen as startdatum, 
                        lpl.datumrijbewijsgehaald FROM lespakketleerling lpl
                RIGHT JOIN leerling ll ON ll.id = lpl.leerlingID
                INNER JOIN lespakket lp ON lp.id = lpl.lespakketID
                ORDER BY lpl.startdatumrijlessen ASC;
        ";

        $this->db->query($sql);

        return $this->db->resultSet();
    }
}
