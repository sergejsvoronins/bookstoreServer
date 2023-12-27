<?php
class User {
    public $id = 0;
    private $firstName = "";
    private $lastName = "";
    private $account = "";
    private $password = null;
    private $address = "";
    private $zipCode = 0;
    private $city = "";
    private $mobile = "";
    private $email = "";
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

}