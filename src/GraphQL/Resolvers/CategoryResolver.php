<?php

namespace App\Models;

require_once __DIR__ . '/AbstractModel.php';

class CategoryResolver
{
    private $categoryModel;

    public function __construct($db)
    {
        $this->categoryModel = new Category($db);
    }

    public function resolve($root, $args)
    {
        return $this->categoryModel->find($args['id']);
    }
}
