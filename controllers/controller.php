<?php
require "classes/book.php";
require "classes/category.php";
require "classes/author.php";
require "classes/order.php";
require "classes/shipment.php";
require "classes/loginUser.php";
require "classes/user.php";
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
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $queryParams = parse_str($url, $params);
        $matchedRoute = null;
        if(count($parts) == 3){
            if(isset($params['q']) && strncmp($parts[2], "search", 6) === 0) {
                $matchedRoute = $this->routes[$this->method]["search"];

            }
            else if(($this->routes[$this->method][$parts[2]])){
                $matchedRoute = $this->routes[$this->method][$parts[2]];
            }
        }
        else if(count($parts) == 4 && isset($this->routes[$this->method][$parts[2] . "/"])){
            $matchedRoute = $this->routes[$this->method][$parts[2] . "/"];
        }

        if ($matchedRoute) {
            $id = $parts[3] ?? null;
            $query = $params['q'] ?? null;
            $model = $matchedRoute['model'];
            $method = $matchedRoute['method'];
            switch ($this->method) {
                case 'GET':
                    $this->handleGetRoute($model, $method, $id, $query);
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
        else {
            http_response_code(404);
            echo "Page is not found";
        }
        
    }
    private function handleGetRoute($model, $method, $id, $query) : void {

        if ($id || $id === "") {
            $response = $model->$method((int)$id);
            
            if (count($response)!=0) {
                switch ($model->getTable()) {
                        case "categories" : 
                                $this->view->outputJsonSingle($model->$method((int)$id));
                                break;
                        case "authors" : 
                                $this->view->outputJsonSingle($model->$method((int)$id));
                                break;
                        case "books" :
                            $this->view->outputJsonSingle($model->$method((int)$id)[0]);
                            break;
                        // case "search" :
                        //     $this->view->outputJsonCollection($model->$method())
                        default :
                            $this->view->outputJsonSingle($model->$method((int)$id)[0]);
                            break;
                        }
            }
            else {
                http_response_code(404);
                echo "Not Found";
            }
        } 
        else if ($query) {
            $newString = str_replace("+", " ", $query);
            $this->view->outputJsonCollection($model->$method($newString));

        }
        else {
            $this->view->outputJsonCollection($model->$method());

        } 
    }
    private function handlePostRoute ($model, $method, $element) : void {
        $data = file_get_contents("php://input");
        $requestData = json_decode($data, true);
        $requestData["email"] = filter_var($requestData["email"],FILTER_SANITIZE_SPECIAL_CHARS) ?? null;
        $requestData["password"] = filter_var($requestData["password"],FILTER_SANITIZE_SPECIAL_CHARS)?? null;
        $requestData["title"] = filter_var($requestData["title"],FILTER_SANITIZE_SPECIAL_CHARS)?? null;
        $requestData["description"] = filter_var($requestData["description"] ?? null,FILTER_SANITIZE_SPECIAL_CHARS)?? null;
        $requestData["imgUrl"] = filter_var($requestData["imgUrl"] ?? null,FILTER_SANITIZE_URL)?? null;
        $requestData["pages"] = filter_var((int)$requestData["pages"],FILTER_SANITIZE_NUMBER_INT)?? null;
        $requestData["year"] = filter_var((int)$requestData["year"],FILTER_SANITIZE_NUMBER_INT)?? null;
        $requestData["language"] = filter_var($requestData["language"],FILTER_SANITIZE_SPECIAL_CHARS)?? null;
        $requestData["authorId"] = filter_var((int)$requestData["authorId"],FILTER_SANITIZE_NUMBER_INT)?? null;
        $requestData["categoryId"] = filter_var((int)$requestData["categoryId"],FILTER_SANITIZE_NUMBER_INT)?? null;
        $requestData["price"] = filter_var((int)$requestData["price"],FILTER_SANITIZE_NUMBER_INT)?? null;
        $requestData["isbn"] = filter_var((int)$requestData["isbn"],FILTER_SANITIZE_NUMBER_INT)?? null;
        $requestData["firstName"] = filter_var($requestData["firstName"],FILTER_SANITIZE_SPECIAL_CHARS)?? null;
        $requestData["lastName"] = filter_var($requestData["lastName"],FILTER_SANITIZE_SPECIAL_CHARS)?? null;
        $requestData["address"] = filter_var($requestData["address"],FILTER_SANITIZE_SPECIAL_CHARS)?? null;
        $requestData["zipCode"] = filter_var((int)$requestData["zipCode"],FILTER_SANITIZE_NUMBER_INT)?? null;
        $requestData["city"] = filter_var($requestData["city"],FILTER_SANITIZE_SPECIAL_CHARS)?? null;
        $requestData["mobile"] = filter_var((int)$requestData["mobile"],FILTER_SANITIZE_NUMBER_INT)?? null;
        $requestData["name"] = filter_var($requestData["name"] ?? null,FILTER_SANITIZE_SPECIAL_CHARS)?? null;
        $requestData["created"] = filter_var($requestData["created"] ?? null,FILTER_SANITIZE_NUMBER_INT)?? null;
        switch($element) {
            case ("users") :
                if (empty($requestData['email']) || preg_match('/^\s*$/', $requestData['email'])) {
                    http_response_code(400);
                    echo json_encode([
                        'message' => 'The email cannot be empty.'
                    ]);
                    return;
                }
                if (empty($requestData['password']) || preg_match('/^\s*$/', $requestData['email'])) {
                    http_response_code(400);
                    echo json_encode([
                        'message' => 'The password cannot be empty.'
                    ]);
                    return;
                }
                $user = new User ($requestData["password"],$requestData["email"],);
                
                $id = $model->$method($user);
                break;
            case ("books") : 
                if ((int)$requestData['pages'] === 0) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The number of pages cannot be 0.'
                ]);
                return;
                }

                if ((int)$requestData['year'] === 0) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The year of publication cannot be 0.'
                ]);
                return;
                }
                if ((int)$requestData['price'] === 0) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The price  cannot be 0.'
                ]);
                return;
                }
                if ((int)$requestData['isbn'] === 0) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'ISBN cannot be 0.'
                ]);
                return;
                }

                // Validate text fields
                if (empty($requestData['title'])) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The title cannot be empty.'
                ]);
                return;
                }

                // Validate for empty spaces in text fields
                if (preg_match('/^\s*$/', $requestData['title'])) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The title cannot consist only of spaces.'
                ]);
                return;
                }
                $book = new Book (
                    $requestData["title"],
                    $requestData["description"],
                    $requestData["imgUrl"],
                    (int) $requestData["pages"],
                    (int) $requestData["year"],
                    $requestData["language"],
                    (int) $requestData["authorId"],
                    (int) $requestData["categoryId"],
                    (int) $requestData["price"],
                    (int) $requestData["isbn"],
                );
                $id = $model->$method($book);
                break;
            case ("categories") :
                $requestData["name"] = filter_var($requestData["name"],FILTER_SANITIZE_SPECIAL_CHARS);
                $category = new Category (
                    $requestData["name"]
                );
            $id = $model->$method($category);
            break;
            case ("authors") :
                $requestData["name"] = filter_var($requestData["name"],FILTER_SANITIZE_SPECIAL_CHARS);
                $author = new Author (
                    $requestData["name"],

                );
            $id = $model->$method($author);
            break;
            case ("orders") :
                $order = new Order (
                   (int) $requestData["totalPrice"],
                   (int) $requestData["shipmentId"],
                   (array) $requestData["books"],
                );
            $id = $model->$method($order);
            break;
            case ("shipments") :
                // Validate text fields
                if (empty($requestData['firstName'] || preg_match('/^\s*$/', $requestData['firstName']))) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The firstname cannot be empty.'
                ]);
                return;
                }
                if (empty($requestData['lastName']) || preg_match('/^\s*$/', $requestData['lastName'])) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The lastname cannot be empty.'
                ]);
                return;
                }
                if (empty($requestData['address']) || preg_match('/^\s*$/', $requestData['address'])) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The address cannot be empty.'
                ]);
                return;
                }
                if (empty($requestData['city']) || preg_match('/^\s*$/', $requestData['city'])) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The city cannot be empty.'
                ]);
                return;
                }
                if (empty($requestData['mobile']) || preg_match('/^\s*$/', $requestData['mobile'])) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The mobile cannot be empty.'
                ]);
                return;
                }
                if (empty($requestData['email']) || preg_match('/^\s*$/', $requestData['email'])) {
                http_response_code(400);
                echo json_encode([
                    'message' => 'The email cannot be empty.'
                ]);
                return;
                }
                if (empty($requestData['zipCode']) || preg_match('/^\s*$/', $requestData['zipCode'])) {
                    http_response_code(400);
                    echo json_encode([
                        'message' => 'The zip code cannot be empty.'
                    ]);
                    return;
                }

                $shipment = new Shipment (
                    $requestData["firstName"],
                    $requestData["lastName"],
                    $requestData["address"],
                    $requestData["zipCode"],
                    $requestData["city"],
                    $requestData["mobile"],
                    $requestData["email"],
                );
            $id = $model->$method($shipment);
            break;
            case "login" :
                if (empty($requestData['email']) || preg_match('/^\s*$/', $requestData['email'])) {
                    http_response_code(400);
                    echo json_encode([
                        'message' => 'The email cannot be empty.'
                    ]);
                    return;
                }
                if (empty($requestData['password']) || preg_match('/^\s*$/', $requestData['email'])) {
                    http_response_code(400);
                    echo json_encode([
                        'message' => 'The password cannot be empty.'
                    ]);
                    return;
                }
                $loginUser = new LoginUser ($requestData["email"],$requestData["password"]);
                
                $this->view->outputJsonCollection($model->$method($loginUser));
                break;
        }
         if($id){
            http_response_code(201);
            echo json_encode([
                "message" => ucfirst(substr($element, 0, -1)) . " is created",
                "id" => (int)$id
            ]);
        }
    }
    private function handlePutRoute ($model, $method, $element, int $id) : void {
        if($id) {
            $data = file_get_contents("php://input");
            $requestData = json_decode($data, true);
            switch($element) {
                case ("books") : 
                    $item = "Book";

                    $book = new Book (
                        $requestData["title"],
                        $requestData["description"],
                        $requestData["imgUrl"],
                        (int) $requestData["pages"],
                        (int) $requestData["year"],
                        $requestData["language"],
                        (int) $requestData["authorId"],
                        (int) $requestData["categoryId"],
                        (int) $requestData["price"],
                        (int) $requestData["isbn"]
                    );
                    $response = $model->$method($book, $id);
                    break;
                case ("categories") :
                    $item = "Category";

                    $category = new Category (
                    $requestData["name"]
                    );
                    $response = $model->$method($category, $id);
                    break;
                case ("authors") :
                    $item = "Author";
                    $requestData["name"] = filter_var($requestData["name"] ?? null,FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["created"] = filter_var($requestData["created"] ?? null,FILTER_SANITIZE_NUMBER_INT);
                    $author = new Author (
                    $requestData["name"],
                    );
                    $response = $model->$method($author, $id);
                    break;
            }
            if($response!=0){
                http_response_code(200);
                echo json_encode([
                    "message" => "$item with ID = $id has been updated"
                ]);
            }
        }
    }
    private function handleDeleteRoute ($model, $method, int $id) : void {
        if($id) {
            $model->$method($id);
        }
    }

}