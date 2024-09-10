<?php

namespace App\Models;

require_once __DIR__ . '/AbstractModel.php';

class PriceResolver
{
    private $priceModel;

    public function __construct($db)
    {
        $this->priceModel = new Price($db);
    }

    public function resolve($root, $args)
    {
        return $this->priceModel->find($args['id']);
    }
}
