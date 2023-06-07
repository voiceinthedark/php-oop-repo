<?php
require_once __DIR__ . '/../app/autoloader.php';

session_start();
setcookie('username', 'firas', time() + 3600);

define('STORAGE_PATH', __DIR__ . '/../storage');

use app\classes\Home;
use app\classes\Invoice;
use app\classes\Router;



$route = new Router();

$route->get('/', [Home::class, 'index'])
      ->get('/invoice', [Invoice::class, 'index'])
      ->get('/invoice/create', [Invoice::class, 'create'])
      ->post('/invoice/create', [Invoice::class, 'store'])
      ->post('/upload', [Home::class, 'upload']);

$route->resolve($_SERVER['REQUEST_URI'], strtolower($_SERVER['REQUEST_METHOD']));

// echo exec('whoami');
