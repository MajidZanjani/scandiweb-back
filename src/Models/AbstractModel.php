<?php

namespace App\Models;

abstract class AbstractModel
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    abstract public function find($id);
    abstract public function all();
}
