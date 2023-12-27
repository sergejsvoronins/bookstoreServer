<?php
require_once "classes/dp.php";
require "classes/author.php";
class AuthorModel extends DB {
    protected $table = "authors";
    public function getAllAuthors () : array {
        return $this->getAll($this->table);
    }
}