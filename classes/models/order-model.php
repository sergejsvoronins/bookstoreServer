<?php
require_once "classes/db.php";
class OrderModel extends DB {
    protected $table = "orders";

    public function addOrder (Order $order) : string {
        $query = "INSERT INTO `orders`(
        `customerId`, 
        `orderDate`,
        `totalPrice`) VALUES (?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$order->customerId, $order->orderDate, $order->totalPrice]);

        $orderId = $this->pdo->lastInsertId();
        foreach ($order->books as $book) {
            $query = "INSERT INTO `orderItems`(
                    `orderId`,
                    `bookId`,
                    `amount`)
                    VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([
                (int)$orderId,
                $book["bookId"],
                $book["amount"]
            ]);
        }


        return $orderId;
    }
}