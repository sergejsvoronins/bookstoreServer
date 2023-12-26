<?php 
class Author {
    public $id = 0;
    public string $firstName = "";
    public string $lastName = "";
    public int $created = 0;
    function __construct(
        $firstName, $lastName, $created
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->created = $created;
    }
    

}