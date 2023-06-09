<?php
require_once __DIR__ . '/../app/autoloader.php';
require __DIR__ . '/../vendor/autoload.php';


session_start();
setcookie('username', 'firas', time() + 3600);

define('STORAGE_PATH', __DIR__ . '/../storage');
define('VIEWS_PATH', __DIR__ . '/../views');

use app\controllers\HomeController;
use app\controllers\InvoiceController;
use app\Router;
use app\View;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

try {

$route = new Router();

$route->get('/', [HomeController::class, 'index'])
      ->get('/download', [HomeController::class, 'download'])
      ->get('/invoice', [InvoiceController::class, 'index'])
      ->get('/invoice/create', [InvoiceController::class, 'create'])
      ->post('/invoice/create', [InvoiceController::class, 'store'])
      ->post('/upload', [HomeController::class, 'upload']);


      $route->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

} catch (\app\exceptions\RouteNotFound $e) {
      // echo $e->getMessage();

      header('HTTP/1.1 404 Not Found');

      View::make('errors/404');
}


// echo exec('whoami');
