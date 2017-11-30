<?php

class Router
{
    private $_url;
    private $_routes = [];
    private $_namedRoutes = [];

    public function __construct($url)
    {
        $this->_url = $url;
    }

    public function get($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    public function post($path, $callable, $name = null)
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    private function add($path, $callable, $name, $method)
    {
        $route = new Route($path, $callable);
        $this->_routes[$method][] = $route;
        if (is_string($callable) && $name === null) {
            $name = $callable;
        }
        if ($name) {
            $this->_namedRoutes[$name] = $route;
        }
        return $route;
    }

    public function run()
    {
        if (empty($this->_routes[$_SERVER['REQUEST_METHOD']])) {
            throw new Exception("REQUEST_METHOD does not exist", 1);
        }
        foreach ($this->_routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->_url)) {
                return $route->call();
            }
        }
        echo "404 not found";
        header('HTTP/1.1 404 Not Found');
        //require_once($basePath.'/Controllers/404Controller.php');
    }

    public function url($name, $params = [])
    {
        if (empty($this->_namedRoutes[$name])) {
            throw new Exception("No route matches this name", 1);
        }
        return $this->_namedRoutes[$name]->getUrl($params);
    }
}
