<?php
class User extends Shipment {
    private $account = "";
    private $password = null;
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