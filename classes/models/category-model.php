<?php
require_once "classes/db.php";
class CategoryModel extends DB {
    protected $table = "categories";
    public function getAllCategories () : array {
        return $this->getAll($this->table);
    }
    public function addCategory (Category $category) : string{
        $query = "INSERT INTO `categories`(`name`, `created`) VALUES (?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$category->name, $category->created]);
        var_dump("här");
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
}