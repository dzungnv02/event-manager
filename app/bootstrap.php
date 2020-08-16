<?php
require dirname(__DIR__).'/vendor/autoload.php';

//connect database
use Classes\DB\DatabaseConnector;
$dbConnection = (new DatabaseConnector())->getConnection();

