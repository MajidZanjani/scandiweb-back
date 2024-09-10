<?php

namespace App\Models;

require_once __DIR__ . '/AbstractModel.php';

class ProductResolver
{
    private $productModel;

    public function __construct($db)
    {
        $this->productModel = new Product($db);
    }

    public function resolve($root, $args)
    {
        return $this->productModel->find($args['id']);
    }
}
