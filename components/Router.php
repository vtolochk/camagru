<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run()
    {
        foreach ($this->routes as $uriPattern => $path)
        {
            var_dump($uriPattern);
            var_dump($uri);
            if (preg_match("~$uriPattern~", $uri)){
                echo $path;
            }
        }
    }
}