<?php
require_once 'app/bootstrap.php';
use App\User;

$user = new User($dbConnection);
$user->insert(['email'=> 'dzungnv02', 'username'=> 'Dzungnv02']);
var_dump($user->findAll());