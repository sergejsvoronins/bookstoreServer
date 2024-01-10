<?php
require_once "classes/db.php";
class AuthorModel extends DB {
    protected $table = "authors";
    public function getAllAuthors () : array {
        return $this->getAll($this->table);
    }
    public function addAuthor (Author $author) : string {
        $query = "INSERT INTO `authors`(
        `name`, 
        `created`) VALUES (?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$author->name, $author->created]);
        return $this->pdo->lastInsertId();
    }
    public function updateAuthor (Author $author, int $id) : int {
        $query = "UPDATE `authors` SET 
            `name`= ?,
            `modified`=? WHERE authors.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$author->name, time(), $id]);
        return $stmt->rowCount();
    }
    public function deleteAuthor (int $id) : void {
        $query = "DELETE FROM `authors` WHERE authors.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
    }
    public function getTable () {
        return $this->table;
    }
}