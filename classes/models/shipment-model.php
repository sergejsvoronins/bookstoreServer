<?php
require_once "classes/db.php";
class ShipmentModel extends DB {
    protected $table = "shipment";

    public function getAllShipments () : array {
        return $this->getAll($this->table);
    }
    public function addShipment (Shipment $shipment) {
        $query = "INSERT INTO `shipments`(
            `firstName`, `lastName`, `address`,
             `zipCode`, `city`, `mobile`, `email`,
              `created`) 
              VALUES (?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$shipment->firstName,$shipment->lastName,$shipment->address,
            $shipment->zipCode,$shipment->city,$shipment->mobile,$shipment->email,$shipment->created]);
        if($this->pdo->lastInsertId()) {
            return $this->pdo->lastInsertId();
        }
        else {
            header("HTTP/1.1 400 Bad Request");
            http_response_code(400);
        }
    }
}