<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;

class GalleryType extends ObjectType
{
    public function __construct()
    {
        $config = [
            'name' => 'Gallery',
            'fields' => [
                'id' => ['type' => Type::nonNull(Type::int())],
                'product_id' => ['type' => Type::string()],
                'image_url' => ['type' => Type::string()],
            ]
        ];
        parent::__construct($config);
    }
}
