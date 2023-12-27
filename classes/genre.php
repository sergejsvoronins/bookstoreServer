<?php
class Genre {
    public $id = 0;
    public string $name = "";
    public int $created = 0;
    public $modified = null;
    function __construct(
        $name, $created
    ) {
        $this->name = $name;
        $this->created = $created;
    }
}