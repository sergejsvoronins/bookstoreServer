<?php
require "classes/book.php";
class Controller {
    private $routes = [];
    private $view = null;
    private $method = "";

    public function __construct($view, $method) {
        $this->view = $view;
        $this->method = $method;
    }
    public function addRoute(string $route, Object $model, string $method, string $requestType) : void
    {

        $this->routes[$requestType][$route] = ['model' => $model, 'method' => $method];

    }
    public function start($request): void
    {

        $parts = explode("/", $request);
        $matchedRoute = null;
        if(count($parts) == 3 && isset($this->routes[$this->method][$parts[2]])){
            $matchedRoute = $this->routes[$this->method][$parts[2]];
        }
        else if(count($parts) == 4 && isset($this->routes[$this->method][$parts[2] . "/"])){
            $matchedRoute = $this->routes[$this->method][$parts[2] . "/"];
        }
        else {
                http_response_code(404);
                echo "Page is not found";
            }
        if ($matchedRoute) {
            $id = $parts[3] ?? null;
            $model = $matchedRoute['model'];
            $method = $matchedRoute['method'];

            switch ($this->method) {
                case 'GET':
                    $this->handleGetRoute($model, $method, $id);
                    break;
                case 'POST':
                    $this->handlePostRoute($model, $method, $parts[2]);
                    break;
                case 'PUT':
                    $this->handlePutRoute($model, $method, $parts[2], (int) $id);
                    break;
                case 'DELETE':
                    $this->handleDeleteRoute($model, $method,(int) $id);
                    break;
                default:
                    http_response_code(405);
                    break;
            }
        } 
        
    }
    private function handleGetRoute($model, $method, $id) : void {

        if ($id || $id === "") {
            $response = $model->$method((int)$id);
            if (count($response)!=0) {
                $this->view->outputJsonSingle($model->$method((int)$id)[0]);
            }
            else {
                http_response_code(404);
                echo "Not Found";
            }
        } else {
            $this->view->outputJsonCollection($model->$method());

        } 
    }
    private function handlePostRoute ($model, $method, $element) : void {
        $data = file_get_contents("php://input");
        $requestData = json_decode($data, true);
        switch($element) {
            case ("books") : 
                $requestData["title"] = filter_var($requestData["title"] ?? null,FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["description"] = filter_var($requestData["description"] ?? null,FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["pages"] = filter_var($requestData["pages"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                $requestData["year"] = filter_var($requestData["year"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                $requestData["language"] = filter_var($requestData["language"] ?? null,FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["authorId"] = filter_var($requestData["authorId"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                $requestData["genreId"] = filter_var($requestData["genreId"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                $requestData["price"] = filter_var($requestData["price"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                $requestData["isbn"] = filter_var($requestData["isbn"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                $book = new Book (
                    $requestData["title"],
                    $requestData["description"],
                    (int) $requestData["pages"],
                    (int) $requestData["year"],
                    $requestData["language"],
                    (int) $requestData["authorId"],
                    (int) $requestData["genreId"],
                    (int) $requestData["price"],
                    (int) $requestData["isbn"],
                );
                
                // var_dump($book);
                $id = $model->$method($book);
                break;
        }
         if($id){
            http_response_code(201);
            echo json_encode([
                "message" => ucfirst(substr($element, 0, -1)) . " is created",
                "id" => $id
            ]);
        }
    }
    private function handlePutRoute ($model, $method, $element, int $id) : void {
        if($id) {
            $data = file_get_contents("php://input");
            $requestData = json_decode($data, true);
            switch($element) {
                case ("books") : 
                    $requestData["title"] = filter_var($requestData["title"] ?? null,FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["description"] = filter_var($requestData["description"] ?? null,FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["pages"] = filter_var($requestData["pages"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                    $requestData["year"] = filter_var($requestData["year"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                    $requestData["language"] = filter_var($requestData["language"] ?? null,FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["authorId"] = filter_var($requestData["authorId"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                    $requestData["genreId"] = filter_var($requestData["genreId"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                    $requestData["price"] = filter_var($requestData["price"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                    $requestData["isbn"] = filter_var($requestData["isbn"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                    $requestData["created"] = filter_var($requestData["created"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                    $book = new Book (
                        $requestData["title"],
                        $requestData["description"],
                        (int) $requestData["pages"],
                        (int) $requestData["year"],
                        $requestData["language"],
                        (int) $requestData["authorId"],
                        (int) $requestData["genreId"],
                        (int) $requestData["price"],
                        (int) $requestData["isbn"]
                    );
                    $response = $model->$method($book, $id);
                    break;
            }
            if($response!=0){
                http_response_code(200);
                echo json_encode([
                    "message" => "Book with ID = $id has been updated"
                ]);
            }
        }
    }
    private function handleDeleteRoute ($model, $method, int $id) : void {
        var_dump("här");
        if($id) {
            $model->$method($id);
        }
    }

}