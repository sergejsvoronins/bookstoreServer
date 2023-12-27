<?php
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
                // case 'POST':
                //     $this->handlePostRoute($model, $method, $parts[2]);
                //     break;
                // case 'PUT':
                //     $this->handlePutRoute($model, $method, $id);
                //     break;
                default:
                    http_response_code(405);
                    break;
            }
        } 
        
    }
        private function handleGetRoute($model, $method, $id) : void {
        if ($id || $id === "") {
            // $errors = $this->getValidationErrors(["id" => $id]);
            // if(! empty($errors)) {
            //     $this->view->outputJsonValidationsError($errors);
            // }
            // else {
            //     $response = $model->$method((int)$id);
            //     if (count($response)!=0) {
            //         $this->view->outputJsonSingle($model->$method((int)$id)[0]);
            //     }
            //     else {
            //         http_response_code(404);
            //         echo "Not Found";
            //     }
                
            // }
        } else {
            $this->view->outputJsonCollection($model->$method());

        } 
    }
}