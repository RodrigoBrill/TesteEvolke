<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Process extends DataLayer
{
    public function __construct()
    {
        parent::__construct("processess", ["process_name","person_id","unit_id","status_id"]);
    }

    public function persons()
    {
        return (new Person())->find("id = :pid", "pid={$this->person_id}")->fetch(true);
    }

    public function units()
    {
        return (new Unit())->find("id = :pid", "pid={$this->unit_id}")->fetch(true);
    }

    public function status()
    {
        return (new Status())->find("id = :pid", "pid={$this->status_id}")->fetch(true);
    }
}