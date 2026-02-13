<?php session_start();
use Dotenv\Dotenv;
use Model\ActiveRecord;
use MVC\View;


require __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();


ini_set('display_errors', $_ENV['DEBUG_MODE']);
ini_set('display_startup_errors', $_ENV['DEBUG_MODE']);
error_reporting(-$_ENV['DEBUG_MODE']);
ini_set('error_log', __DIR__ . '/../logs/error.log');
View::init(
    __DIR__ . '/../views',          // ajusta a tu ruta real de views
    __DIR__ . '/../views/layout.php' // ajusta a tu layout real
);

require 'helpers.php';
require 'funciones.php';
require 'routes.php';
// Conectarnos a la base de datos