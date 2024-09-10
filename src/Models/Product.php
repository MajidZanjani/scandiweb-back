<?php

namespace App\Models;

require_once __DIR__ . '/AbstractModel.php';

class Product extends AbstractModel
{
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function findByCategory($category)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category = :category");
        $stmt->execute(['category' => $category]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
