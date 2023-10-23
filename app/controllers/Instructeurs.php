<?php

class Instructeurs extends BaseController
{
    private InstructeursModel $instructeurModel;
    private VoertuigenModel  $voertuigenModel;
    public function __construct()
    {
        $this->instructeurModel = $this->model("InstructeursModel");
        $this->voertuigenModel = $this->model("VoertuigenModel");
    }
    public function index()
    {
        $data = [
            "aantal" => $this->instructeurModel->countInstructeurs(),
            "instructeur-data" => $this->instructeurModel->getInstructeurs()
        ];

        $this->view('instructeurs/index', $data);
    }
    public function voertuigen($id)
    {
        $data = [
            "instructeur" => $this->instructeurModel->getInstructeur($id),
            "voertuigen"  => $this->instructeurModel->getVoertuigenOf($id),
            "geen_voertuigen" => "",
            "deleted" => $_GET["deleted"] ?? null
        ];
        if (sizeof($data["voertuigen"]) < 1) {
            $data["geen_voertuigen"] = "Er zijn op dit moment nog geen voertuigen toegewezen aan deze instructeur<br>";
            header("Refresh: 3; url=" . URLROOT . "instructeurs");
        }
        $this->view("instructeurs/voertuigen", $data);
    }
    public function toevoegen($id)
    {
        $extra_data = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (array_key_exists("id", $_POST)) {
                $extra_data = $this->handle_toevoegen_post($_POST["id"], $id);
            }
        }
        $data = [
            "instructeur" => $this->instructeurModel->getInstructeur($id),
            "voertuigen"  => $this->voertuigenModel->getAllVehiclesAndCategory(),
            "extra" => $extra_data,
            "deleted" => $_GET["deleted"] ?? null
        ];
        $this->view("instructeurs/toevoegen", $data);
    }
    private function handle_toevoegen_post($voertuigID, $instructeurID)
    {
        if (!$this->instructeurModel->checkIfVoertuigAlreadyBound($voertuigID, $instructeurID)) {
            $this->instructeurModel->bindVoertuigToInstructeur($voertuigID, $instructeurID);
            return ["success" => "Het voertuig is toegevoegd aan de instructeur "];
        } else {
            return ["success" => "Het voertuig is al van de instructeur!"];
        }
    }
}
