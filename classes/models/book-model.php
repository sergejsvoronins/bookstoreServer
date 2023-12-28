<?php
require_once "classes/db.php";
class BookModel extends DB
{
    protected $table = "books";
    public function getAllBooks(): array
    {
        return $this->getAll($this->table);
    }
    public function getSingleBook(int $id)
    {
        $query = "SELECT b.id, title, description, pages, year, language, price, isbn, CONCAT(a.firstName, ' ', a.lastName) AS author, c.name AS category FROM `books` AS b
            JOIN authors AS a ON a.id = b.authorId
            JOIN categories AS c ON c.id = b.categoryId
            WHERE b.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }
    public function addBook(Book $book) : string
    {
        $query = "INSERT INTO `books`(
            `title`, 
            `description`, 
            `pages`, 
            `year`, 
            `language`, 
            `authorId`, 
            `categoryId`, 
            `price`, 
            `isbn`,
            `created`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$book->title, $book->description, $book->pages, $book->year, $book->language, $book->authorId, $book->categoryId, $book->price, $book->isbn, $book->created]);
        var_dump("här");
        return $this->pdo->lastInsertId();
    }

    public function updateBook(Book $book, int $id) : int {
        $query = "UPDATE `books` SET 
            `title`= ?,
            `description`=?,
            `pages`=?,
            `year`=?,
            `language`=?,
            `authorId`=?,
            `categoryId`=?,
            `price`=?,
            `isbn`=?,
            `modified`=? WHERE books.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$book->title, $book->description, $book->pages, $book->year, $book->language, $book->authorId, $book->categoryId, $book->price, $book->isbn, time(), $id]);
        return $stmt->rowCount();
    }
    public function deleteBook (int $id) : void {
        $query = "DELETE FROM `books` WHERE books.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
    }
}