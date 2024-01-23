<?php
require_once "classes/db.php";
class OrderModel extends DB {
    protected $table = "orders";

    public function addOrder (Order $order) : string {
            $query = "INSERT INTO `orders`(
            `orderDate`,
            `totalPrice`,
            `shipmentId`) VALUES (?,?,?)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute([$order->orderDate, $order->totalPrice, $order->shipmentId]);
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

    public function getAllOrders () {
        $query = "SELECT `id`, `orderStatus`,`orderDate` FROM `orders`";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
       return $stmt->fetchAll();
    }
    public function getOneOrder (int $id) {
        $queryOrder = "SELECT * FROM `orders` AS o WHERE o.id = ?";
        $stmt = $this->pdo->prepare($queryOrder);
        $stmt->execute([$id]);
        $order =  $stmt->fetchAll();
        $queryShipment = "SELECT `firstName`, `lastName`, `address`, `zipCode`, `city`, `mobile`, `email`, `created`, `modified` FROM `shipments` AS s WHERE s.id = ?";
        $stmt = $this->pdo->prepare($queryShipment);
        $stmt->execute([$order[0]["shipmentId"]]);
        $shipment = $stmt->fetchAll();
        $queryOrderBooks = "SELECT b.* FROM `orderitems` AS oi
            JOIN books AS b ON oi.bookId = b.id
            WHERE oi.orderId = ?";
        $stmt = $this->pdo->prepare($queryOrderBooks);
        $stmt->execute([$id]);
        $books = $stmt->fetchAll();
        $order[0]["shipmentDetails"] = $shipment;
        $order[0]["books"] = $books;
        return $order;
    }
    public function updateOrder (Order $order, int $id) {
        $query = "UPDATE `orders` AS o SET `orderStatus`= ?,`Modified`= ? WHERE o.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$order->orderStatus, time(), $id]);
        return $stmt->fetchAll();
    }
    public function getTable () {
        return $this->table;
    }

}