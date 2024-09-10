<?php

namespace App\Models;

require_once __DIR__ . '/AbstractModel.php';

class AttributeResolver
{
    private $attributeModel;

    public function __construct($db)
    {
        $this->attributeModel = new Attribute($db);
    }

    public function resolve($root, $args)
    {
        return $this->attributeModel->find($args['id']);
    }
}
