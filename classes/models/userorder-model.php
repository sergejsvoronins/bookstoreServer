<?php
require_once "classes/db.php";
class UserOrderModel extends DB {
    protected $table = "userorders";
    public function addUserOrder (Order $order) : string {
        $query = "INSERT INTO `userorders`( `orderDate`, `totalPrice`, `userId`, `shipmentId`) VALUES (?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$order->orderDate, $order->totalPrice, $order->userId,  $order->shipmentId]);
        $orderId = $this->pdo->lastInsertId();
        foreach ($order->books as $book) {
            $query = "INSERT INTO `userorderitems`(
                    `userOrderId`,
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
    public function getAllUserOrders (int $id) {
        $query = "SELECT `id`, `orderStatus`, `orderDate` FROM `userorders` WHERE userId = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
       return $stmt->fetchAll();
    }
    public function getOneUserOrder (int $id) {
        $queryOrder = "SELECT * FROM `userorders` AS u WHERE u.id = ?";
        $stmt = $this->pdo->prepare($queryOrder);
        $stmt->execute([$id]);
        $order =  $stmt->fetchAll();
        $queryShipment = "SELECT `firstName`, `lastName`, `address`, `zipCode`, `city`, `mobile`, `email`, `created`, `modified` FROM `shipments` AS s WHERE s.id = ?";
        $stmt = $this->pdo->prepare($queryShipment);
        $stmt->execute([$order[0]["shipmentId"]]);
        $shipment = $stmt->fetchAll();
        $queryOrderBooks = "SELECT b.* FROM `userorderitems` AS ui
            JOIN books AS b ON ui.bookId = b.id
            WHERE ui.userOrderId = ?";
        $stmt = $this->pdo->prepare($queryOrderBooks);
        $stmt->execute([$id]);
        $books = $stmt->fetchAll();
        $queryUser = "SELECT `firstName`, `lastName`, `accountLevel`, `address`, `zip`, `city`, `mobile`, `email` FROM `users` WHERE id = ?";
        $stmt = $this->pdo->prepare($queryUser);
        $stmt->execute([$order[0]["userId"]]);
        $user = $stmt->fetchAll();
        $order[0]["shipmentDetails"] = $shipment;
        $order[0]["books"] = $books;
        $order[0]["userinfo"] = $user[0];
        return $order;
        }
    public function updateUserOrder (Order $order, int $id) {
        $query = "UPDATE `userorders` AS uo SET `orderStatus`= ?,`Modified`= ? WHERE uo.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$order->orderStatus, time(), $id]);
        return $stmt->fetchAll();
    }
    public function getTable () {
        return $this->table;
    }
}