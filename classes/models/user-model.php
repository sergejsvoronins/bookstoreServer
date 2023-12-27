<?php
require_once "classes/db.php";
class UserModel extends DB {
    protected $table = "customers";
    public function getAllUsers () : array {
        return $this->getAll($this->table);
    }
}