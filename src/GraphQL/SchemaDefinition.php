<?php

namespace App\GraphQL;

use GraphQL\Type\Schema;

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
