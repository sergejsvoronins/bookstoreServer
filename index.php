<?php
require "classes/models/author-model.php";
$authors = new AuthorModel();
var_dump($authors->getAllAuthors());
// require "classes/models/product-model.php";
// require "classes/views/secondhand-api.php";
// require "controllers/controller.php";

// header("Content-Type: application/json");
// $request = $_SERVER['REQUEST_URI'];
// $method = $_SERVER['REQUEST_METHOD'];
// $sellerModel = new SellerModel();
// $productModel = new ProductModel();
// $secondhandApi = new SecondhandApi();
// $controler = new Controller($secondhandApi, $method);
// $controler->addRoute("sellers", $sellerModel, "getAllSellers", "GET");
// $controler->addRoute("sellers/", $sellerModel, "getOneSeller", "GET");
// $controler->addRoute("sellers", $sellerModel, "addSeller", "POST");
// $controler->addRoute("products", $productModel, "getAllProducts", "GET");
// $controler->addRoute("products/", $productModel, "getOneProduct", "GET");
// $controler->addRoute("products/", $productModel, "addSellingDate", "PUT");
// $controler->addRoute("products", $productModel, "addProduct", "POST");
// $controler->start($request);
echo "bokstore";