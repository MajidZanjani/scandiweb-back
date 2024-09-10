<?php

namespace App\GraphQL;

use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use App\GraphQL\Types\TypeRegistry;
use GraphQL\Type\Definition\Type;

class SchemaDefinition
{
    public static function build($db)
    {
        return new Schema([
            'query' => new QueryType($db),
            'mutation' => new MutationType($db),
        ]);
    }
}

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
                        $productModel = new \App\Models\Product($db);
                        if (isset($args['category'])) {
                            return $productModel->findByCategory($args['category']);
                        }
                        return $productModel->all();
                    },
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
