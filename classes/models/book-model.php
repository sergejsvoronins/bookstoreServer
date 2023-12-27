<?php
require_once "classes/db.php";
class BookModel extends DB {
        protected $table = "books";
    public function getAllBooks () : array {
        return $this->getAll($this->table);
    }
}