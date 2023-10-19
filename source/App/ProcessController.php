<?php

namespace Source\App;

use League\Plates\Engine;
use Source\Models\Process;
use Source\Models\Unit;
use Source\Models\Person;
use Source\Models\Status;

class ProcessController
{
    private $view;

    public function __construct()
    {
        $this->view = Engine::create(__DIR__ . "/../../views", "php");
    }

    public function index()
    {
        $process = new Process();
        $list = $process->find()->fetch(true);
        $response = [];

        foreach ($list as $key => $value) {
            $response[$key]['codigo'] = $value->data()->id;
            $response[$key]['nome'] = $value->data()->process_name;
            $response[$key]['pessoa'] = $value->persons[0]->data()->person_name;
            $response[$key]['unidade'] = $value->units[0]->data()->unit_name;
            $response[$key]['status'] = $value->status[0]->data()->status_name;
            $response[$key]['criacao'] = $value->data()->created_at;
            $response[$key]['edicao'] = $value->data()->updated_at ?? '-';
        }

        echo $this->view->render("list-process", [
            "list" => $response
        ]);
    }

    public function new($id)
    {
        $unit = new Unit();
        $unit_list = $unit->find()->fetch(true);

        $person = new Person();
        $person_list = $person->find()->fetch(true);

        $status = new Status();
        $status_list = $status->find()->fetch(true);

        echo $this->view->render("create-process", [
            "unit_list" => $unit_list,
            "person_list" => $person_list,
            "status_list" => $status_list
        ]);
    }

    public function create($data)
    {
        $process = new Process();
        $process->process_name = $data['nome'];
        $process->person_id = $data['pessoa'];
        $process->unit_id = $data['unidade'];
        $process->status_id = $data['status'];
        $process->save();
    }

    public function edit($data)
    {
        $unit = new Unit();
        $unit_list = $unit->find()->fetch(true);

        $person = new Person();
        $person_list = $person->find()->fetch(true);

        $status = new Status();
        $status_list = $status->find()->fetch(true);

        $model = new Process();
        $process = $model->findById($data['id']);

        echo $this->view->render("edit-process", [
            "unit_list" => $unit_list,
            "person_list" => $person_list,
            "status_list" => $status_list,
            "process" => $process
        ]);
    }

    public function update($data)
    {
        $model = new Process();
        $process = $model->findById($data['id']);
        $process->process_name = $data['nome'];
        $process->person_id = $data['pessoa'];
        $process->unit_id = $data['unidade'];
        $process->status_id = $data['status'];
        $process->save();
    }

    public function delete($data)
    {
        $process = (new Process())->findById($data['id']);
        $process->destroy();
    }

    public function error($data)
    {
        echo "<h1> Erro {$data["errcode"]} </h1>";
    }
}