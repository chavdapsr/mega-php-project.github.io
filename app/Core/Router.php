<?php

namespace App\Core;

class Router
{
    private $routes = [];
    private $params = [];

    public function add($method, $path, $controller, $action, $middleware = [])
    {
        $this->routes[] = [
            'method' => strtoupper($method),
            'path' => $path,
            'controller' => $controller,
            'action' => $action,
            'middleware' => $middleware
        ];
    }

    public function get($path, $controller, $action, $middleware = [])
    {
        $this->add('GET', $path, $controller, $action, $middleware);
    }

    public function post($path, $controller, $action, $middleware = [])
    {
        $this->add('POST', $path, $controller, $action, $middleware);
    }

    public function put($path, $controller, $action, $middleware = [])
    {
        $this->add('PUT', $path, $controller, $action, $middleware);
    }

    public function delete($path, $controller, $action, $middleware = [])
    {
        $this->add('DELETE', $path, $controller, $action, $middleware);
    }

    public function match()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = rtrim($uri, '/') ?: '/';

        foreach ($this->routes as $route) {
            $pattern = $this->convertToRegex($route['path']);
            
            if ($route['method'] === $method && preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                $this->params = $matches;
                return $route;
            }
        }

        return null;
    }

    private function convertToRegex($path)
    {
        $path = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '([a-zA-Z0-9_-]+)', $path);
        return '#^' . $path . '$#';
    }

    public function getParams()
    {
        return $this->params;
    }
}
