<?php

// Display errors in browser
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();

//Including files
define('ROOT', dirname(__FILE__));
require_once(ROOT.'/components/Router.php');
require_once(ROOT.'/components/Database.php');

//Call router run function
$router = new Router();
$router->run();