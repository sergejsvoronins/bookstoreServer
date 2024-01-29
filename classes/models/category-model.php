<?php
require_once "classes/db.php";
class CategoryModel extends DB {
    protected $table = "categories";
    public function getAllCategories () : array {
        $query = "SELECT c.*, COUNT(b.id) AS 'booksAmount' FROM categories AS c
            LEFT JOIN books AS b ON b.categoryId = c.id
            GROUP BY c.id";
        $stmt = $this->pdo->prepare($query);    
        $stmt->execute();
        return $stmt->fetchAll(); 
    }
    public function getCategoryBooks (int $id) {
        $queryCategoryBooks = "SELECT b.id AS bookId, b.title, b.imgUrl, b.price, c.name AS category FROM `categories` AS c
        JOIN books AS b ON c.id = b.categoryId
        WHERE c.id = ?";
        $stmt = $this->pdo->prepare($queryCategoryBooks);
        $stmt->execute([$id]);
        $books =  $stmt->fetchAll();
        $queryCategory = "SELECT * FROM `categories` AS c
        WHERE c.id = ?";
        $stmt = $this->pdo->prepare($queryCategory);
        $stmt->execute([$id]);
        $category = $stmt->fetchAll()[0];
        if($category == NULL) {
            header("HTTP/1.1 400 Bad Request");
            http_response_code(400);
        }
        else {
            return [
                "id" => $category["id"],
                "name" => $category["name"],
                "books" => $books
            ];    

        }

    }
    public function addCategory (Category $category) : string{
        $query = "INSERT INTO `categories`(`name`, `created`) VALUES (?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$category->name, $category->created]);
        return $this->pdo->lastInsertId();
    }
    public function updateCategory (Category $category, int $id) {
        $query = "UPDATE `categories` SET 
        `name`= ?,
        `modified`=? WHERE categories.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$category->name, time(), $id]);
        if($stmt->rowCount() !== 0) {
            return $stmt->rowCount();
        }
        else {
            header("HTTP/1.1 400 Bad Request");
            http_response_code(400);
        }
    }
    public function deleteCategory (int $id) {
        $query = "DELETE FROM `categories` WHERE categories.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
    }
    public function getTable () {
        return $this->table;
    }
}