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
        //spliting url in parts

        $parts = explode("/", $request);

        //checking if there is a query
        
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $queryParams = parse_str($url, $params);
        $matchedRoute = null;

        //depends on $parts amount and parts value calling respective methods for respective route

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

    //function that handle all routes with GET method
    private function handleGetRoute($model, $method, $id, $query) : void {

        if ($id || $id === "") {
            $response = $model->$method((int)$id);
            if (count($response)!=0) {
                switch ($model->getTable()) {
                    case "categories" : 
                        $this->view->outputJsonCollection($model->$method((int)$id));
                        break;
                    case "user-orders" : 
                        if($method === "getAllUsersOrders") {
                            $this->view->outputJsonCollection($model->$method((int)$id));
                            return;
                        } 
                        $this->view->outputJsonSingle($model->$method((int)$id));
                    break;
                    default :
                        $this->view->outputJsonSingle($model->$method((int)$id));
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
    //function that handle all routes with POST method
    private function handlePostRoute ($model, $method, $element) : void {
        $data = file_get_contents("php://input");
        $requestData = json_decode($data, true);
        $errors = $this->getValidationErrors($requestData); 
        if(count($errors) !== 0) {
            http_response_code(400);
            echo json_encode([
                "error" => $errors,
            ]);
            return;
        }
        switch($element) {
            case ("users") :
                $requestData["email"] = filter_var($requestData["email"],FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["password"] = filter_var($requestData["password"],FILTER_SANITIZE_SPECIAL_CHARS);
                $user = new User ($requestData["password"],$requestData["email"]);
                $id = $model->$method($user);
                break;
            case ("books") : 
                $requestData["title"] = filter_var($requestData["title"],FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["description"] = filter_var($requestData["description"],FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["imgUrl"] = filter_var($requestData["imgUrl"],FILTER_SANITIZE_URL);
                $requestData["pages"] = filter_var($requestData["pages"],FILTER_SANITIZE_NUMBER_INT);
                $requestData["year"] = filter_var($requestData["year"],FILTER_SANITIZE_NUMBER_INT);
                $requestData["language"] = filter_var($requestData["language"],FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["authorId"] = filter_var($requestData["authorId"],FILTER_SANITIZE_NUMBER_INT);
                $requestData["categoryId"] = filter_var($requestData["categoryId"],FILTER_SANITIZE_NUMBER_INT);
                $requestData["price"] = filter_var($requestData["price"],FILTER_SANITIZE_NUMBER_INT);
                $requestData["isbn"] = filter_var($requestData["isbn"],FILTER_SANITIZE_SPECIAL_CHARS);
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
                    $requestData["isbn"],
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
                $requestData["totalPrice"] = filter_var($requestData["totalPrice"],FILTER_SANITIZE_NUMBER_INT);
                $requestData["shipmentId"] = filter_var($requestData["shipmentId"],FILTER_SANITIZE_NUMBER_INT);
                $order = new Order (
                    (int) $requestData["totalPrice"],
                    NULL,
                    (int) $requestData["shipmentId"],
                    (array) $requestData["books"],
                );

               
            $id = $model->$method($order);
            break;
            case ("user-orders") :
                $requestData["totalPrice"] = filter_var($requestData["totalPrice"],FILTER_SANITIZE_NUMBER_INT);
                $requestData["shipmentId"] = filter_var($requestData["shipmentId"],FILTER_SANITIZE_NUMBER_INT);
                $requestData["userId"] = filter_var($requestData["userId"],FILTER_SANITIZE_NUMBER_INT);
                $order = new Order (
                    (int) $requestData["totalPrice"],
                    (int)$requestData["userId"],
                    (int) $requestData["shipmentId"],
                    (array) $requestData["books"],
                );
            $id = $model->$method($order);
            break;
            case ("shipments") :
                $requestData["firstName"] = filter_var($requestData["firstName"],FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["lastName"] = filter_var($requestData["lastName"],FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["address"] = filter_var($requestData["address"],FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["zipCode"] = filter_var($requestData["zipCode"],FILTER_SANITIZE_NUMBER_INT);
                $requestData["city"] = filter_var($requestData["city"],FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["mobile"] = filter_var($requestData["mobile"],FILTER_SANITIZE_NUMBER_INT);
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
                $requestData["email"] = filter_var($requestData["email"],FILTER_SANITIZE_SPECIAL_CHARS);
                $requestData["password"] = filter_var($requestData["password"],FILTER_SANITIZE_SPECIAL_CHARS);
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
    //function that handle all routes with PUT method
    private function handlePutRoute ($model, $method, $element, int $id) : void {
        if($id) {
            $data = file_get_contents("php://input");
            $requestData = json_decode($data, true);
            $errors = [];
            if($element != "user-level") {
                $errors = $this->getValidationErrors($requestData); 
                if(count($errors) !== 0) {
                    http_response_code(400);
                    echo json_encode([
                        "error" => $errors,
                    ]);
                    return;
                }
            }
            switch($element) {
                case ("user-password") :
                    $item = "Password";

                    $requestData["password"] = filter_var($requestData["password"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["oldPassword"] = filter_var($requestData["oldPassword"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $user = new User ($requestData["password"]);
                    $response = $model->$method($user, $id, $requestData["oldPassword"]);
                    break;
                case ("user-level") :
                    $item = "Account level";
                    if(array_key_exists("accountLevel", $requestData)) {
                        if($requestData["accountLevel"] != "user" && $requestData["accountLevel"] != "admin") {
                            $errors [] = "accountLevel does not match";
                        }
                        $requestData["accountLevel"] = filter_var($requestData["accountLevel"],FILTER_SANITIZE_SPECIAL_CHARS);
                        $user = new User (
                            $requestData['firstName'],
                            $requestData['lastName'],
                            $requestData['address'],
                            $requestData['zipCode'],
                            $requestData['city'],
                            $requestData['mobile'],
                            $requestData['accountLevel'],
                        );
                        
                        $response = $model->$method($user, $id);
                    }
                break;
                case ("users") :
                    $item = "User";
                    $requestData["firstName"] = filter_var($requestData["firstName"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["lastName"] = filter_var($requestData["lastName"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["address"] = filter_var($requestData["address"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["zipCode"] = filter_var($requestData["zipCode"],FILTER_SANITIZE_NUMBER_INT);
                    $requestData["city"] = filter_var($requestData["city"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["mobile"] = filter_var($requestData["mobile"],FILTER_SANITIZE_NUMBER_INT);
                    $user = new User (
                        $requestData['firstName'],
                        $requestData['lastName'],
                        $requestData['address'],
                        $requestData['zipCode'],
                        $requestData['city'],
                        $requestData['mobile'],
                    );
                    
                    $response = $model->$method($user, $id);
                break;
                case ("books") : 
                    $item = "Book";
                    $requestData["title"] = filter_var($requestData["title"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["description"] = filter_var($requestData["description"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["imgUrl"] = filter_var($requestData["imgUrl"],FILTER_SANITIZE_URL);
                    $requestData["pages"] = filter_var($requestData["pages"],FILTER_SANITIZE_NUMBER_INT);
                    $requestData["year"] = filter_var($requestData["year"],FILTER_SANITIZE_NUMBER_INT);
                    $requestData["language"] = filter_var($requestData["language"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $requestData["authorId"] = filter_var($requestData["authorId"],FILTER_SANITIZE_NUMBER_INT);
                    $requestData["categoryId"] = filter_var($requestData["categoryId"],FILTER_SANITIZE_NUMBER_INT);
                    $requestData["price"] = filter_var($requestData["price"],FILTER_SANITIZE_NUMBER_INT);
                    $requestData["isbn"] = filter_var($requestData["isbn"],FILTER_SANITIZE_SPECIAL_CHARS);
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
                        $requestData["isbn"]
                    );
                    $response = $model->$method($book, $id);
                break;
                case ("categories") :
                    $item = "Category";
                    $requestData["name"] = filter_var($requestData["name"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $category = new Category (
                        $requestData["name"]
                    );
                    $response = $model->$method($category, $id);
                    break;
                case ("authors") :
                    $item = "Author";
                    $requestData["name"] = filter_var($requestData["name"],FILTER_SANITIZE_SPECIAL_CHARS);
                    $author = new Author (
                        $requestData["name"],
                    );
                    $response = $model->$method($author, $id);
                    break;
                case ("orders") :
                    $order = new Order (
                        $requestData["orderStatus"]
                    );
                    $response = $model->$method($order, $id);
                    break;
                case ("user-orders") :
                    $order = new Order (
                        $requestData["orderStatus"]
                    );
                $response = $model->$method($order, $id);
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

    //function that validates possible errors
    private function getValidationErrors($data) : array {
        $errors = [];
        if(is_array($data) && ! empty($data)){
            if(array_key_exists("firstName", $data)) {
                if(empty($data["firstName"]) || preg_match('/^\s*$/', $data['firstName'])) {
                    $errors [] = "firstName is required";
                }
            }
            if(array_key_exists("lastName", $data)) {
                if(empty($data["lastName"]) || preg_match('/^\s*$/', $data['lastName'])) {
                    $errors [] = "lastName is required";
                }
            }
            if(array_key_exists("address", $data)) {
                if(empty($data["address"]) || preg_match('/^\s*$/', $data['address'])) {
                    $errors [] = "address is required";
                }
            }
            if(array_key_exists("zipCode", $data)) {
                if(empty($data["zipCode"]) || preg_match('/^\s*$/', $data['zipCode'])) {
                    $errors [] = "zipCode is required";
                }
            }
            if(array_key_exists("city", $data)) {
                if(empty($data["city"]) || preg_match('/^\s*$/', $data['city'])) {
                    $errors [] = "city is required";
                }
            }
            if(array_key_exists("mobile", $data)) {
                $phonePattern = '/^07[0-9]{8}+$/';
                if (!preg_match($phonePattern, $data["mobile"])) {
                    $errors [] = "mobile is wrong format";
                }
            }
            if(array_key_exists("id", $data)) {
                if(filter_var($data["id"],FILTER_VALIDATE_INT)=== false) {
                    $errors [] = "id must be of type number";
                }
            }
            if(array_key_exists("email", $data)) {
                if(filter_var($data["email"],FILTER_VALIDATE_EMAIL)=== false) {
                    $errors [] = "this is not email";
                }
            }
            if(array_key_exists("password", $data)) {
                if(strlen($data["password"])<6) {
                    $errors [] = "password must contain at least 6 characters";
                }
            }
            if(array_key_exists("oldPassword", $data)) {
                if(strlen($data["oldPassword"])<6) {
                    $errors [] = "oldPassword must contain at least 6 characters";
                }
            }
            if(array_key_exists("title", $data)) {
                if(empty($data["title"]) || preg_match('/^\s*$/', $data['title'])) {
                    $errors [] = "title is required";
                }
            }
            if(array_key_exists("accountLevel", $data)) {
                if($data["accountLevel"] != "user" && $data["accountLevel"] != "admin") {
                    $errors [] = "accountLevel does not match";
                }
            }
            if(array_key_exists("orderStatus", $data)) {
                if($data["orderStatus"] != "new" && 
                    $data["orderStatus"] != "processing" &&
                    $data["orderStatus"] != "shipped" &&
                    $data["orderStatus"] != "completed" &&
                    $data["orderStatus"] != "canceled" &&
                    $data["orderStatus"] != "returned"
                ) {
                    $errors [] = "accountLevel does not match";
                }
            }
            if(array_key_exists("name", $data)) {
                if(empty($data["name"]) || preg_match('/^\s*$/', $data['name'])) {
                    $errors [] = "name is required";
                }
            }
            if(array_key_exists("language", $data)) {
                if(empty($data["language"]) || preg_match('/^\s*$/', $data['language'])) {
                    $errors [] = "language is required";
                }
            }
            if(array_key_exists("isbn", $data)) {
                if(filter_var($data["isbn"],FILTER_VALIDATE_INT)=== false || !(strlen($data["isbn"]) !== 13 || strlen($data["isbn"]) !== 10)) {
                    $errors [] = "isbn is wrong format";
                }
            }
            if(array_key_exists("price", $data)) {
                if(filter_var($data["price"],FILTER_VALIDATE_INT)=== false || (int)$data["price"] < 1) {
                    $errors [] = "price must be of type integer and more than 0";
                }
            }
            if(array_key_exists("totalPrice", $data)) {
                if(filter_var($data["totalPrice"],FILTER_VALIDATE_INT)=== false || (int)$data["totalPrice"] < 1) {
                    $errors [] = "totalprice must be of type integer and more than 0";
                }
            }
            if(array_key_exists("pages", $data)) {
                if(filter_var($data["pages"],FILTER_VALIDATE_INT)=== false || (int)$data["pages"] < 1) {
                    $errors [] = "pages must be of type integer and more than 0";
                }
            }
            if(array_key_exists("year", $data)) {
                if(filter_var($data["year"],FILTER_VALIDATE_INT)=== false || (int)$data["year"] < 1 || (int)$data["year"] > (int)date('Y')) {
                    $errors [] = "year is wrong format";
                }
            }
            if(array_key_exists("authorId", $data)) {
                if(filter_var($data["authorId"],FILTER_VALIDATE_INT)=== false || (int)$data["authorId"] < 1) {
                    $errors [] = "authorId must be integer";
                }
            }
            if(array_key_exists("categoryId", $data)) {
                if(filter_var($data["categoryId"],FILTER_VALIDATE_INT)=== false || (int)$data["categoryId"] < 1) {
                    $errors [] = "categoryId must be integer";
                }
            }
            if(array_key_exists("shipmentId", $data)) {
                if(filter_var($data["shipmentId"],FILTER_VALIDATE_INT)=== false || (int)$data["shipmentId"] < 1) {
                    $errors [] = "shipmentId must be integer";
                }
            }
            if(array_key_exists("userId", $data)) {
                if(filter_var($data["userId"],FILTER_VALIDATE_INT)=== false || (int)$data["userId"] < 1) {
                    $errors [] = "userId must be integer";
                }
            }

            
            return $errors;
        }
        else {
            http_response_code(422);
            return $errors;
        }
    }

}