<?php
require_once "classes/db.php";
class GenreModel extends DB {
    protected $table = "genres";
    public function getAllGenres () : array {
        return $this->getAll($this->table);
    }
}