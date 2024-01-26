<?php
require_once "classes/db.php";
class BookModel extends DB
{
    protected $table = "books";
    public function getAllBooks(): array
    {
        $query = "SELECT b.id, title, description, imgUrl, pages, year, language, price, isbn, b.authorId, a.name AS author, b.categoryId, c.name AS category FROM `books` AS b
            JOIN authors AS a ON a.id = b.authorId
            JOIN categories AS c ON c.id = b.categoryId";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
        // return $this->getAll($this->table);
    }
    public function getSingleBook(int $id)
    {
        $query = "SELECT b.id, title, description, imgUrl, pages, year, language, price, isbn, b.authorId, a.name AS author, b.categoryId, c.name AS category FROM `books` AS b
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
            `imgUrl`,
            `pages`, 
            `year`, 
            `language`, 
            `authorId`, 
            `categoryId`, 
            `price`, 
            `isbn`,
            `created`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$book->title, $book->description,$book->imgUrl, $book->pages, $book->year, $book->language, $book->authorId, $book->categoryId, $book->price, $book->isbn, $book->created]);
        return $this->pdo->lastInsertId();
    }

    public function updateBook(Book $book, int $id) : int {
        $query = "UPDATE `books` SET 
            `title`= ?,
            `description`=?,
            `imgUrl`=?,
            `pages`=?,
            `year`=?,
            `language`=?,
            `authorId`=?,
            `categoryId`=?,
            `price`=?,
            `isbn`=?,
            `modified`=? WHERE books.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$book->title, $book->description,$book->imgUrl, $book->pages, $book->year, $book->language, $book->authorId, $book->categoryId, $book->price, $book->isbn, time(), $id]);
        if($stmt->rowCount() !== 0) {
            return $stmt->rowCount();
        }
        else {
            header("HTTP/1.1 400 Bad Request");
            http_response_code(400);
        }
    }
    public function deleteBook (int $id) : void {
        $query = "DELETE FROM `books` WHERE books.id = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
    }
        public function getTable () {
        return $this->table;
    }

    public function getTopFive () : array {
        $query = "SELECT b.id, b.title, b.imgUrl, b.price, COUNT(b.id) AS amount
            FROM books AS b
            JOIN (
            SELECT bookId
            FROM orderitems
            UNION ALL
            SELECT bookId
            FROM userorderitems
            ) AS oi ON b.id = oi.bookId
            GROUP BY b.id
            ORDER BY amount DESC
            LIMIT 10";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

