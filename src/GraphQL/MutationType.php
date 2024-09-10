<?php

namespace App\GraphQL;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class MutationType extends ObjectType
{
    public function __construct($db)
    {
        $config = [
            'name' => 'Mutation',
            'fields' => [
                'createOrder' => [
                    'type' => Type::boolean(),
                    'args' => [
                        'productId' => ['type' => Type::nonNull(Type::string())],
                        'quantity' => ['type' => Type::nonNull(Type::int())]
                    ],
                    'resolve' => function ($root, $args) use ($db) {
                        $stmt = $db->prepare("INSERT INTO orders (product_id, quantity) VALUES (:product_id, :quantity)");
                        return $stmt->execute([
                            'product_id' => $args['productId'],
                            'quantity' => $args['quantity']
                        ]);
                    }
                ]
            ]
        ];
        parent::__construct($config);
    }
}
