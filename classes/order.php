<?php

class Order {
    public $id = 0;
    public $orderDate = 0;
    public $totalPrice = 0;
    public $shipmentId = 0;
    public $books = array();
    public $orderStatus = "new";
    public $userId = null;
    public $modified = null;
    function __construct() {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();
        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }
    function __construct1( $orderStatus) {
        $this->orderStatus = $orderStatus;
    }
    function __construct4( $totalPrice, $userId, $shipmentId, $books) {
        $this->userId = $userId;
        $this->orderDate = time();
        $this->totalPrice = $totalPrice;
        $this->shipmentId = $shipmentId;
        $this->books = $books;
    }
}