<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Unit extends DataLayer
{
    public function __construct()
    {
        parent::__construct("units", ["unit_name"], "id", false);
    }
}