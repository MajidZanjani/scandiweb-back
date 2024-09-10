<?php

namespace App\Models;

require_once __DIR__ . '/AbstractModel.php';

class Category extends AbstractModel
{
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function all()
    {
        $stmt = $this->db->query("SELECT * FROM categories");
        return $stmt->fetchAll();
    }
}
