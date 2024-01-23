<?php
class User extends Shipment {
    private $accountLevel = "";
    private $password = "user";

    function __construct() {
        $arguments = func_get_args();
        $numberOfArguments = func_num_args();
        if (method_exists($this, $function = '__construct'.$numberOfArguments)) {
            call_user_func_array(array($this, $function), $arguments);
        }
    }
    function __construct1($password) {
        $this->password = $password;
    }
    function __construct2(
        $password,
        $email
    )
    {
        $this->password = $password;
        $this->email = $email;
        $this->accountLevel = "user";
        $this->created = time();

    }
    function __construct6(
        $firstName,
        $lastName,
        $address,
        $zipCode,
        $city,
        $mobile,
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->mobile = $mobile;
    }
    function __construct7(
        $firstName,
        $lastName,
        $address,
        $zipCode,
        $city,
        $mobile,
        $accountLevel
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->mobile = $mobile;
        $this->accountLevel = $accountLevel;
    }
    function getPassword () {
        return $this->password;
    }
    function getAcccountLevel () {
        return $this->accountLevel;
    }

}