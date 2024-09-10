<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class CategoryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Category',
            'fields' => [
                'id' => ['type' => Type::nonNull(Type::int())],
                'name' => ['type' => Type::string()],
                'description' => ['type' => Type::string()]
            ]
        ];
        parent::__construct($config);
    }
}
