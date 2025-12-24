<?php
class OrderModel
{
    private PDO $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    // Các phương thức liên quan đến đơn hàng sẽ được thêm vào đây
    public function getAll(): array
    {
        $sql = "SELECT 
            order_id,
            user.user_id,
            user.name,
            total_amount,
            order_date,
            note,
            shipping_adress
        FROM 
            orders ord 
        JOIN 
            users user ON ord.user_id = user.user_id
        ORDER BY 
        order_id ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO orders (user_id, total_amount, note, order_date, shipping_adress)
                VALUES (:user_id, :total_amount, :note, NOW(), :shipping_adress)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);

        return $this->conn->lastInsertId();
    }

    public function createOrderDetail($data)
    {
        $sql = "INSERT INTO order_details (order_id, product_id, unit_price, quantity)
                VALUES (:order_id, :product_id, :unit_price, :quantity)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }

}
?>