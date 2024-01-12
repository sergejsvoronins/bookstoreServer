<?php

class Order {
    public $id = 0;
    public $customerId = 0;
    public $orderDate = 0;
    public $totalPrice = 0;
    public $books = array();
    public $modified = null;
    function __construct($customerId, $totalPrice, $books) {
        $this->customerId = $customerId;
        $this->orderDate = time();
        $this->totalPrice = $totalPrice;
        $this->books = $books;
    }
}