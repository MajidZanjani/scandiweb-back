<?php

namespace App\Models;

require_once __DIR__ . '/AbstractModel.php';

class Gallery extends AbstractModel
{
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM galleries WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM galleries");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByProductId($productId)
    {
        $stmt = $this->db->prepare("SELECT * FROM galleries WHERE product_id = :product_id");
        $stmt->execute(['product_id' => $productId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
