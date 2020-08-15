<?php
require_once 'vendor/autoload.php';

use Classes\Router\AltoRouter;

$router = new AltoRouter();

$router->map('GET', '/', 'CRUD#getConnection');

$router->map('GET', '/greeting', function(){
    return <<<HTML
    <h1>Happy new year!</h1>
HTML;
});
