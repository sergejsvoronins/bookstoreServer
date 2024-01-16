<?php
class User extends Shipment {
    private $accountLevel = "";
    private $password = null;
    function __construct(
        $firstName,
        $lastName,
        $accountLevel,
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
        $this->accountLevel = $accountLevel;
        $this->password = $password;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->mobile = $mobile;
        $this->email = $email;
        $this->created = $created;

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