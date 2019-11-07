<?php

namespace App\Routing;

class Router {

    private $routes = [];

    public function addRoute(string $method, string $url, string $controller, string $action) {
        $url = rtrim($url, '/');
        $controller = 'App\Controller\\' . $controller;

        $this->routes[$method][$url] = [
            'controller' => $controller,
            'action' => $action
        ];

        return $this;
    }

    public function get(string $url, string $controller, string $action) {
        $this->addRoute('GET', $url, $controller, $action);
        return $this;
    }

    public function post(string $url, string $controller, string $action) {
        $this->addRoute('POST', $url, $controller, $action);
        return $this;
    }

    public function patch(string $url, string $controller, string $action) {
        $this->addRoute('PATCH', $url, $controller, $action);
        return $this;
    }

    
    public function run(string $method, string $url) {

        if (!isset($this->routes[$method][$url])) {
            return $this->handleNotFound();
        }
                
        $controller = new $this->routes[$method][$url]['controller'];
        
        $action = $this->routes[$method][$url]['action'];

        return $controller->$action();
    }


    public function handleNotFound() {
        return http_response_code(404);
    }
}