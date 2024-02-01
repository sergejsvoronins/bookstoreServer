<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization');
header('Access-Control-Allow-Headers: Content-Type, Accept, Authorization');
require "classes/models/author-model.php";
require "classes/models/book-model.php";
require "classes/models/category-model.php";
require "classes/models/search-model.php";
require "classes/models/user-model.php";
require "classes/models/order-model.php";
require "classes/models/shipment-model.php";
require "classes/models/login-user-model.php";
require "classes/models/userorder-model.php";
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
$searchModel = new SearchModel();
$orderModel = new OrderModel();
$shipmentModel = new ShipmentModel();
$loginUserModel = new LoginUserModel();
$userOrderModel = new UserOrderModel();
$userModel = new UserModel();
$controler = new Controller($bookstoreView, $method);

// Creating routes

$controler->addRoute("books", $bookModel, "getAllBooks", "GET");
$controler->addRoute("top-books", $bookModel, "getTopBooks", "GET");
$controler->addRoute("new-books", $bookModel, "getNewArrivals", "GET");
$controler->addRoute("books/", $bookModel, "getSingleBook", "GET");
$controler->addRoute("books", $bookModel, "addBook", "POST");
$controler->addRoute("books/", $bookModel, "updateBook", "PUT");
$controler->addRoute("books/", $bookModel, "deleteBook", "DELETE");
$controler->addRoute("categories", $categoryModel, "getAllcategories", "GET");
$controler->addRoute("categories/", $categoryModel, "getCategoryBooks", "GET");
$controler->addRoute("categories", $categoryModel, "addCategory", "POST");
$controler->addRoute("categories/", $categoryModel, "updateCategory", "PUT");
$controler->addRoute("categories/", $categoryModel, "deleteCategory", "DELETE");
$controler->addRoute("authors", $authorModel, "getAllAuthors", "GET");
$controler->addRoute("authors/", $authorModel, "getOneAuthor", "GET");
$controler->addRoute("authors", $authorModel, "addAuthor", "POST");
$controler->addRoute("authors/", $authorModel, "updateAuthor", "PUT");
$controler->addRoute("authors/", $authorModel, "deleteAuthor", "DELETE");
$controler->addRoute("users", $userModel, "getAllUsers", "GET");
$controler->addRoute("users/", $userModel, "getOneUser", "GET");
$controler->addRoute("users", $userModel, "addUser", "POST");
$controler->addRoute("users/", $userModel, "updateUser", "PUT");
$controler->addRoute("user-level/", $userModel, "updateUserLevel", "PUT");
$controler->addRoute("user-password/", $userModel, "updatePassword", "PUT");
$controler->addRoute("users/", $userModel, "deleteUser", "DELETE");
$controler->addRoute("search", $searchModel, "getSearchBooks", "GET");
$controler->addRoute("orders", $orderModel, "getAllOrders", "GET");
$controler->addRoute("orders/", $orderModel, "getOneOrder", "GET");
$controler->addRoute("orders", $orderModel, "addOrder", "POST");
$controler->addRoute("orders/", $orderModel, "updateOrder", "PUT");
$controler->addRoute("orders/", $orderModel, "deleteOrder", "DELETE");
$controler->addRoute("user-orders", $userOrderModel, "getAllUserOrders", "GET");
$controler->addRoute("user-orders/", $userOrderModel, "getAllUsersOrders", "GET");
$controler->addRoute("user-order/", $userOrderModel, "getOneUserOrder", "GET");
$controler->addRoute("user-orders", $userOrderModel, "addUserOrder", "POST");
$controler->addRoute("user-orders/", $userOrderModel, "updateUserOrder", "PUT");
$controler->addRoute("user-orders/", $userOrderModel, "deleteUserOrder", "DELETE");
$controler->addRoute("shipments", $shipmentModel, "addShipment", "POST");
$controler->addRoute("shipments/", $shipmentModel, "deleteShipment", "DELETE");
$controler->addRoute("login", $loginUserModel, "loginUser", "POST");


//Starting API

$controler->start($request);