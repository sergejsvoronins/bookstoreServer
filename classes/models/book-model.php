<?php
require_once "classes/db.php";
class BookModel extends DB {
        protected $table = "books";
    public function getAllBooks () : array {
        return $this->getAll($this->table);
    }
    public function getSingleBook (int $id) {
        $query = "SELECT b.id, title, description, pages, year, language, price, isbn, CONCAT(a.firstName, ' ', a.lastName) AS author, g.name AS genre FROM `books` AS b
            JOIN authors AS a ON a.id = b.authorId
            JOIN genres AS g ON g.id = b.genreId
            WHERE b.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
}