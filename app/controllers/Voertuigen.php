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
                if ($_POST["instructeur"] == "null") {
                    $_POST["instructeur"] = null;
                }
                $this->edit_post($id);
                $instruc_id = $_POST["instructeur"];
                if ($instruc_id == null) {
                    header("Location: /");
                } else {
                    header("Location: /instructeurs/voertuigen/$instruc_id");
                }
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
    public function delete(int $id) {
        $ins_id = $_GET["ins"];
        $this->voertuigenModel->deleteVehicle($id);
        if ($_GET["type"] != "toevoegen") {
            header("Location: /instructeurs/voertuigen/$ins_id?deleted=true");
        } else {
            header("Location: /instructeurs/toevoegen/$ins_id?deleted=true");
        }
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