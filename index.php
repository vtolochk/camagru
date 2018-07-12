<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');

$router = new Router();
$router->run();