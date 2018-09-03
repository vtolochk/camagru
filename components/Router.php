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
    private function goHome()
    {
        include_once(ROOT . '/controllers/' . 'IndexController.php');
        $index = 'IndexController';
        $indexObject = new $index;
        $indexObject->actionIndex();
    }
    public function run()
    {
        $success = 0;
        $uri = $this->getURI();
        if (!$uri)
            $this->goHome();
        else
        {
            foreach ($this->routes as $uriPattern => $path)
            {
                if (preg_match("~$uriPattern~", $uri)) {
                    $segments = explode('/', $path);
                    $controllerName = ucfirst(array_shift($segments).'Controller');
                    $actionName = 'action'.ucfirst(array_shift($segments));
                    $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                    if (file_exists($controllerFile)) {
                        include_once($controllerFile);
                    }
                    $controllerObject = new $controllerName;
                    if ($controllerObject->$actionName()) {
                        $success = 1;
                        break;
                    }
                }
            }
        }
        if (!$success) {
            include_once(ROOT . '/views/404.php');
        }
    }
}