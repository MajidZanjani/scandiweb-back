<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\Models\Price;
use App\Models\Attribute;
use App\Models\Gallery;

class ProductType extends ObjectType
{
    public function __construct($db)
    {
        $priceModel = new Price($db);
        $attributeModel = new Attribute($db);
        $galleryModel = new Gallery($db);
        $config = [
            'name' => 'Product',
            'fields' => [
                'id' => ['type' => Type::nonNull(Type::string())],
                'name' => ['type' => Type::string()],
                'description' => ['type' => Type::string()],
                'price' => [
                    'type' => TypeRegistry::price(), // Updated to use the custom PriceType
                    'resolve' => function ($product) use ($priceModel) {
                        try {
                            $price = $priceModel->findByProductId($product['id']);
                            return $price && isset($price['amount'], $price['currency_symbol'])
                                ? ['amount' => $price['amount'], 'currency_symbol' => $price['currency_symbol']]
                                : null;
                        } catch (\PDOException $e) {
                            error_log("Error fetching price for product ID {$product['id']}: " . $e->getMessage());
                            return null;
                        }
                    }
                ],
                'category' => ['type' => Type::string()],
                'inStock' => ['type' => Type::boolean()],
                'brand' => ['type' => Type::string()],
                'attributes' => [
                    'type' => Type::listOf(Type::nonNull(TypeRegistry::attribute($db))),
                    'resolve' => function ($product) use ($attributeModel) {
                        try {
                            return $attributeModel->findByProductId($product['id']);
                        } catch (\PDOException $e) {
                            error_log("Error fetching attributes for product ID {$product['id']}: " . $e->getMessage());
                            return [];
                        }
                    }
                ],
                'galleries' => [
                    'type' => Type::listOf(TypeRegistry::gallery()),
                    'resolve' => function ($product) use ($galleryModel) {
                        try {
                            return $galleryModel->findByProductId($product['id']);
                        } catch (\PDOException $e) {
                            error_log("Error fetching galleries for product ID {$product['id']}: " . $e->getMessage());
                            return [];
                        }
                    }
                ]
            ]
        ];
        parent::__construct($config);
    }
}
