<?php
class User extends Shipment {
    private $accountLevel = "";
    private $password = "";
    function __construct(
        // $firstName,
        // $lastName,
        // $accountLevel,
        $password,
        // $address,
        // $zipCode,
        // $city,
        // $mobile,
        $email
    )
    {
        // $this->firstName = $firstName;
        // $this->lastName = $lastName;
        $this->accountLevel = "user";
        $this->password = $password;
        // $this->address = $address;
        // $this->zipCode = $zipCode;
        // $this->city = $city;
        // $this->mobile = $mobile;
        $this->email = $email;
        $this->created = time();

    }
    function getPassword () {
        return $this->password;
    }
    function getAcccountLevel () {
        return $this->accountLevel;
    }
    // function getFirstName () {
    //     return $this->firstName;
    // }
    // function getLastName () {
    //     return $this->lastName;
    // }
    // function getEmail () {
    //     return $this->email;
    // }
    // function geMobile () {
    //     return $this->mobile;
    // }

}