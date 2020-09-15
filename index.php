<?php
use Core\Router;

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

require_once (ROOT . DS . 'vendor' . DS . 'autoload.php');
$dotenv = Dotenv\Dotenv::createUnsafeImmutable(__DIR__);
$dotenv->load();

require_once (ROOT . DS . 'config' . DS . 'config.php');
require_once (ROOT . DS . 'app' . DS . 'lib' . DS . 'helpers.php');

function autoload($className){
    $classAry = explode('\\', $className);
    $class = array_pop($classAry);
    $subPath = strtolower(implode(DS, $classAry));
    $path = ROOT . DS . $subPath . DS . $class . '.php';
    if(file_exists($path)){
        require_once($path);
    }
}

spl_autoload_register('autoload');
session_start();

$url = isset($_SERVER['REQUEST_URI']) ? explode('/', ltrim($_SERVER['REQUEST_URI'], '/')) : [];

Router::route($url);

