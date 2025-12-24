<?php
class CategoryModel
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getAll(): array
    {
        $stmt = $this->conn->query("SELECT * FROM categories ORDER BY category_id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
