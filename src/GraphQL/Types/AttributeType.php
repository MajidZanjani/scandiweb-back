<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use App\Models\AttributeItem;


class AttributeType extends ObjectType
{
    public function __construct($db)
    {
        $attributeItemModel = new AttributeItem($db);
        $config = [
            'name' => 'Attribute',
            'fields' => [
                'id' => ['type' => Type::nonNull(Type::int())],
                'name' => ['type' => Type::string()],
                'value' => ['type' => Type::string()],
                'product_id' => ['type' => Type::string()],
                'type' => ['type' => Type::string()],
                'items' => [
                    'type' => Type::listOf(TypeRegistry::attributeItem()),
                    'resolve' => function ($attribute) use ($attributeItemModel) {
                        try {
                            return $attributeItemModel->findByAttributeId($attribute['id']);
                        } catch (\PDOException $e) {
                            error_log("Error fetching attribute items for attribute ID {$attribute['id']}: " . $e->getMessage());
                            return [];
                        }
                    }
                ]
            ]
        ];
        parent::__construct($config);
    }
}
