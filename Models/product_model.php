<?php
class ProductModel
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getAll(): array
    {
        $sql = "SELECT 
            pro.*, 
            cat.category_name  -- Lấy tên danh mục
        FROM 
            products pro
        JOIN 
            categories cat ON pro.category_id = cat.category_id
        ORDER BY 
            pro.product_id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create(array $data): bool
    {
        $sql = "INSERT INTO products (product_name, category_id, price, discount, image)
                VALUES (:product_name, :category_id, :price, :discount, :image)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'product_name'  => $data['product_name'],
            'category_id'  => $data['category_id'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'image' => $data['image']
        ]);
    }

    public function delete(int $product_id): bool
    {
        $sql = "DELETE FROM products WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute(['product_id' => $product_id]);
    }

    public function getById(int $product_id)
    {
        $sql = "SELECT pro.*, cat.category_name FROM products pro JOIN categories cat ON pro.category_id = cat.category_id WHERE pro.product_id = :product_id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['product_id' => $product_id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByProductId($product_id)
    {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$product_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(int $product_id, array $data): bool
    {
        $sql = "UPDATE products SET product_name = :product_name, category_id = :category_id, price = :price, discount = :discount, image = :image, is_active = :is_active WHERE product_id = :product_id";
        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            'product_name' => $data['product_name'],
            'category_id' => $data['category_id'],
            'price' => $data['price'],
            'discount' => $data['discount'],
            'image' => $data['image'],
            'is_active' => $data['is_active'] ?? 0,
            'product_id' => $product_id,
        ]);
    }

    public function getByCategory(int $category_id): array
    {
    $sql = "SELECT 
                pro.*, 
                cat.category_name
            FROM products pro
            JOIN categories cat ON pro.category_id = cat.category_id
            WHERE pro.category_id = :category_id
            ORDER BY pro.product_id ASC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['category_id' => $category_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchByName(string $keyword)
{
    $sql = "SELECT p.*, c.category_name
            FROM products p
            JOIN categories c ON p.category_id = c.category_id
            WHERE p.product_name LIKE :kw
            ORDER BY p.product_name ASC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        'kw' => '%' . $keyword . '%'
    ]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
 public function find($id) {
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
}