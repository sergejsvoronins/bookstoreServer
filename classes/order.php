<?php

class Order {
    public $id = 0;
    public $orderDate = 0;
    public $totalPrice = 0;
    public $shipmentId = 0;
    public $books = array();
    public $modified = null;
    function __construct($totalPrice, $shipmentId, $books) {
        $this->orderDate = time();
        $this->totalPrice = $totalPrice;
        $this->shipmentId = $shipmentId;
        $this->books = $books;
    }
}