<?php

class Voertuigen extends BaseController {
    private VoertuigenModel $voertuigenModel;
    private InstructeursModel $instructeursModel;
    public function __construct()
    {
        $this->voertuigenModel = $this->model("VoertuigenModel");
        $this->instructeursModel = $this->model("InstructeursModel");
    }

    public function edit($id = null) {
        if ($id == null) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id = $_POST["id"];
                $this->edit_post($id);
                $instruc_id = $_POST["instructeur"];
                header("Location: /instructeurs/voertuigen/$instruc_id");
            } else {
                header("Location: /home/index");
            }
            return;
        }

        $data = [
            "voertuig" => $this->voertuigenModel->getVehicleById($id),
            "instructeurs" => $this->instructeursModel->getInstructeurs(),
            "typevoertuigen" => $this->voertuigenModel->getAllVehicleCategories()
        ];
        
        $this->view("voertuigen/edit", $data);
    }
    private function edit_post(int $id) {
        $this->voertuigenModel->updateVehicle(
            $id,
            $_POST["instructeur"],
            $_POST["typevoertuig"],
            $_POST["type"],
            $_POST["bouwjaar"],
            $_POST["brandstof"],
            $_POST["kenteken"]
        );
    }

}