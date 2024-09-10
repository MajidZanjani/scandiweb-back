<?php

namespace App\Models;

require_once __DIR__ . '/AbstractModel.php';

class AttributeItem extends AbstractModel
{
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM attribute_items WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM attribute_items");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByAttributeId($attributeId)
    {
        $stmt = $this->db->prepare("SELECT * FROM attribute_items WHERE attribute_id = :attribute_id");
        $stmt->execute(['attribute_id' => $attributeId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
