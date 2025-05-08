<?php

require_once __DIR__ . '/../db.php';

class ResourceModel
{
    private $db;

    public function __construct()
    {
        $this->db = getDbConnection();
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO resources (title, type, description, category, created_by)
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['title'],
            $data['type'],
            $data['description'],
            $data['category'],
            $data['created_by']
        ]);
    }

    public function search($keyword)
    {
        $stmt = $this->db->prepare("SELECT * FROM resources WHERE title LIKE ?");
        $stmt->execute(["%" . $keyword . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM resources WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE resources SET title = ?, type = ?, description = ?, category = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['title'],
            $data['type'],
            $data['description'],
            $data['category'],
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM resources WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
