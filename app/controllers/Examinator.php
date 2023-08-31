<?php

class Examinator extends BaseController
{
    private ExaminatorModel $examinatorModel;
    public function __construct()
    {
        $this->examinatorModel = $this->model('ExaminatorModel');
    }
    public function index()
    {

        $data = [
            "examinators" => $this->examinatorModel->getAllExaminators(),
        ];

        $this->view('examinator/index', $data);
    }
}
