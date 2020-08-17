<?php
namespace App\Controllers;

class Route {

    private $routes = [];
    
    public function __construct(){}
    
    public function addRoute($method, $url, $callback)
    {
        $this->routes[] = array('method' => $method, 
                              'url' => $url, 
                              'callback' => $callback);
    }
    
    public function dispatch()
    {
        $reqUrl = $_SERVER['REQUEST_URI'];
        $reqMet = $_SERVER['REQUEST_METHOD'];

        foreach($this->routes as  $route) {
            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['url'])) . "$@D";
            $matches = array();
    
            if($reqMet == $route['method'] && preg_match($pattern, $reqUrl, $matches)) {
                array_shift($matches);
                $result = call_user_func_array($route['callback'], $matches);
                if ($result !== null) {
                    header($result['headers']['status_code']);
                    header('Content-Type:'.$result['headers']['Content-Type']);
                    ob_clean();
                    echo $result['body'];
                }
                exit();
            }
        }
    }
}
