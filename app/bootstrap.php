<?php
require dirname(__DIR__).'/vendor/autoload.php';

use App\Controllers\Route;
use App\Controllers\Request;
use App\Controllers\Response;

//connect database
use Classes\DB\DatabaseConnector;
$dbConnection = (new DatabaseConnector())->getConnection();

$route = new Route();
$request = new Request();
$response = new Response();
