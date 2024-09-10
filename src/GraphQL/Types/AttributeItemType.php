<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class AttributeItemType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'AttributeItem',
            'fields' => [
                'id' => ['type' => Type::nonNull(Type::int())],
                'attribute_id' => ['type' => Type::int()],
                'displayValue' => ['type' => Type::string()],
                'value' => ['type' => Type::string()],
            ]
        ];
        parent::__construct($config);
    }
}
