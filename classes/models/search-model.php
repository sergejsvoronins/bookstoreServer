<?php
require_once "classes/db.php";

class SearchModel extends DB {
    public function getSearchBooks (string $text) {
        $query = "SELECT b.id, title, description, imgUrl, pages, year, language, price, isbn, a.name AS author, c.name AS category FROM `books` AS b
            JOIN categories AS c ON c.id = b.categoryId
            JOIN authors AS a ON a.id = b.authorId
            WHERE b.title LIKE '%$text%' OR a.name LIKE '%$text%'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}