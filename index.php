<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization');
require "classes/models/author-model.php";
require "classes/models/book-model.php";
require "classes/models/category-model.php";
require "classes/models/user-model.php";
require "classes/views/bookstore-view.php";
require "controllers/controller.php";
if($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods:GET,POST,PUT,DELETE,OPTIONS");
    header("Access-Control-Allow-Headers: Authorization, Content-Type,Accept, Origin");exit;
}
$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$bookstoreView = new BookstoreView();
$authorModel = new AuthorModel();
$bookModel = new BookModel();
$categoryModel = new CategoryModel();
$userModel = new UserModel();
$controler = new Controller($bookstoreView, $method);

// Creating routes

$controler->addRoute("books", $bookModel, "getAllBooks", "GET");
$controler->addRoute("books/", $bookModel, "getSingleBook", "GET");
$controler->addRoute("books", $bookModel, "addBook", "POST");
$controler->addRoute("books/", $bookModel, "updateBook", "PUT");
$controler->addRoute("books/", $bookModel, "deleteBook", "DELETE");
$controler->addRoute("categories", $categoryModel, "getAllcategories", "GET");
$controler->addRoute("categories", $categoryModel, "addCategory", "POST");
$controler->addRoute("categories/", $categoryModel, "updateCategory", "PUT");
$controler->addRoute("categories/", $categoryModel, "deleteCategory", "DELETE");
$controler->addRoute("authors", $authorModel, "getAllAuthors", "GET");
$controler->addRoute("authors", $authorModel, "addAuthor", "POST");
$controler->addRoute("authors/", $authorModel, "updateAuthor", "PUT");
$controler->addRoute("authors/", $authorModel, "deleteAuthor", "DELETE");
$controler->addRoute("users", $userModel, "getAllUsers", "GET");

//Starting API
$controler->start($request);