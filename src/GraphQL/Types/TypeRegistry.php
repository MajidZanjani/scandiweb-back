<?php

namespace App\GraphQL\Types;

class TypeRegistry
{
    private static $product;
    private static $category;
    private static $attribute;
    private static $attributeItem;
    private static $gallery;
    private static $price;


    public static function product($db)
    {
        if (self::$product === null) {
            self::$product = new ProductType($db);
        }
        return self::$product;
    }

    public static function category()
    {
        if (self::$category === null) {
            self::$category = new CategoryType();
        }
        return self::$category;
    }

    public static function attribute($db)
    {
        if (self::$attribute === null) {
            self::$attribute = new AttributeType($db);
        }
        return self::$attribute;
    }

    public static function attributeItem()
    {
        if (self::$attributeItem === null) {
            self::$attributeItem = new AttributeItemType();
        }
        return self::$attributeItem;
    }

    public static function price()
    {
        return self::$price ?: (self::$price = new PriceType());
    }

    public static function gallery()
    {
        if (self::$gallery === null) {
            self::$gallery = new GalleryType();
        }
        return self::$gallery;
    }
}
