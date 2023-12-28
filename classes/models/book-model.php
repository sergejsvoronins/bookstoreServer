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
        $query = "SELECT b.id, title, description, pages, year, language, price, isbn, CONCAT(a.firstName, ' ', a.lastName) AS author, g.name AS genre FROM `books` AS b
            JOIN authors AS a ON a.id = b.authorId
            JOIN genres AS g ON g.id = b.genreId
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
            `genreId`, 
            `price`, 
            `isbn`,
            `created`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$book->title, $book->description, $book->pages, $book->year, $book->language, $book->authorId, $book->genreId, $book->price, $book->isbn, $book->created]);
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
            `genreId`=?,
            `price`=?,
            `isbn`=?,
            `modified`=? WHERE books.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$book->title, $book->description, $book->pages, $book->year, $book->language, $book->authorId, $book->genreId, $book->price, $book->isbn, time(), $id]);
        return $stmt->rowCount();
    }
    public function deleteBook (int $id) : void {
        $query = "DELETE FROM `books` WHERE books.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
    }
}