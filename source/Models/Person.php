<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class Person extends DataLayer
{
    public function __construct()
    {
        parent::__construct("persons", ["person_name"], "id", false);
    }
}