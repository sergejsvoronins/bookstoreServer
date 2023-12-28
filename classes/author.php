<?php 
class Author {
    public $id = 0;
    public string $firstName = "";
    public string $lastName = "";
    public int $created = 0;
    public $modified = null;
    function __construct(
        $firstName, $lastName
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->created = time();
    }
    

}