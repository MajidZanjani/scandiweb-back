<?php

namespace App\GraphQL;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\TypeRegistry;

class QueryType extends ObjectType
{
    public function __construct($db)
    {
        $config = [
            'name' => 'Query',
            'fields' => [
                'products' => [
                    'type' => Type::listOf(TypeRegistry::product($db)),
                    'args' => [
                        'category' => [
                            'type' => Type::string(),
                            'description' => 'Category to filter products by',
                        ],
                    ],
                    'resolve' => function ($root, $args) use ($db) {
                        if (isset($args['category'])) {
                            $stmt = $db->prepare("SELECT * FROM products WHERE category = :category");
                            $stmt->execute(['category' => $args['category']]);
                        } else {
                            $stmt = $db->query("SELECT * FROM products");
                        }
                        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    }
                ],
                'product' => [
                    'type' => TypeRegistry::product($db),
                    'args' => [
                        'id' => [
                            'type' => Type::nonNull(Type::string()),
                            'description' => 'ID of the product to retrieve',
                        ],
                    ],
                    'resolve' => function ($root, $args) use ($db) {
                        $stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
                        $stmt->execute(['id' => $args['id']]);
                        return $stmt->fetch(\PDO::FETCH_ASSOC);
                    }
                ],
                'categories' => [
                    'type' => Type::listOf(TypeRegistry::category()),
                    'resolve' => function () use ($db) {
                        $stmt = $db->query("SELECT * FROM categories");
                        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
                    }
                ],
            ]
        ];
        parent::__construct($config);
    }
}
