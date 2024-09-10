<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class PriceType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Price',
            'fields' => [
                'amount' => ['type' => Type::nonNull(Type::float())],
                'currency_symbol' => ['type' => Type::nonNull(Type::string())],
            ]
        ];
        parent::__construct($config);
    }
}
