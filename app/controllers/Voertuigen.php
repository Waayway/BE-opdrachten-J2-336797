<?php

class Voertuigen extends BaseController {
    private VoertuigenModel $voertuigenModel;
    public function __construct()
    {
        $this->voertuigenModel = $this->model("VoertuigenModel");
    }

    public function edit($id = null) {
        if ($id == null) {
            $this->view("home/index");
            return;
        }

        $data = [
            "voertuig" => $this->voertuigenModel->getVehicleById($id)
        ];
        
        $this->view("voertuigen/edit", $data);
    }

}