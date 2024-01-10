<?php
class User {
    public $id = 0;
    private $firstName = null;
    private $lastName = null;
    private $account = "";
    private $password = null;
    private $address = null;
    private $zipCode = 0;
    private $city = null;
    private $mobile = null;
    private $email = null;
    public $created = 0;
    public $modified = null;
    function __construct(
        $firstName,
        $lastName,
        $account,
        $password,
        $address,
        $zipCode,
        $city,
        $mobile,
        $email,
        $created,
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->account = $account;
        $this->password = $password;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->created = $created;

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