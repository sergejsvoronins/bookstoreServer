<?php

class Shipment  {
    public $id = 0;
    public $firstName = "";
    public $lastName = "";
    public $address = "";
    public $zipCode = 0;
    public $city = "";
    public $mobile = "";
    public $email = "";
    public $created = 0;
    public $modified = null;
    function __construct(
        $firstName,
        $lastName,
        $address,
        $zipCode,
        $city,
        $mobile,
        $email
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->created = time();

    }
    function getFirstName () {
        return $this->firstName;
    }
    function getLastName () {
        return $this->lastName;
    }
    function getEmail () {
        return $this->email;
    }
    function geMobile () {
        return $this->mobile;
    }
}