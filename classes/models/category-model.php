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
    public function getCategoryBooks (int $id) : array {
        $query = "SELECT c.id, c.name, b.id, b.title, b.imgUrl, b.price FROM `categories` AS c
        JOIN books AS b ON c.id = b.categoryId
        WHERE c.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
    public function addCategory (Category $category) : string{
        $query = "INSERT INTO `categories`(`name`, `created`) VALUES (?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$category->name, $category->created]);
        return $this->pdo->lastInsertId();
    }
    public function updateCategory (Category $category, int $id): int {
        $query = "UPDATE `categories` SET 
        `name`= ?,
        `modified`=? WHERE categories.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$category->name, time(), $id]);
        return $stmt->rowCount();
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