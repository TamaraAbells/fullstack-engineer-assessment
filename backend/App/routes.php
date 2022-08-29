<?php



$router = new \App\Core\Route();

$router->get('', ['HomeController', 'index']);
$router->get('migration', ['HomeController', 'migration']);

// Book Endpoints
$router->get('api/books', ['BookController', 'index']);
$router->get('api/books/get-book', ['BookController', 'show']);

