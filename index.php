<?php
require_once __DIR__.'/app/bootstrap.php';

$route->addRoute('GET', '/api/users', function() use ($dbConnection, $request, $response) {
    $userController = new App\Controllers\UserController($dbConnection, $request, $response);
    $response = $userController->getAllUser();
    header("Content-Type:". $response["headers"]["Content-Type"]);
    echo $response['body'];
});

$route->addRoute('GET', '/api/user/:id', function($id) use ($dbConnection, $request, $response) {
    $userController = new App\Controllers\UserController($dbConnection, $request, $response);
    $response = $userController->getUser($id);
    header("Content-Type:". $response["headers"]["Content-Type"]);
    echo $response['body'];
});

//Get all Event
$route->addRoute('GET', '/api/events', function() use ($dbConnection, $request, $response){
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    $response = $eventController->getAllEvent();
    header("Content-Type:". $response["headers"]["Content-Type"]);
    echo $response['body'];
});

//Get an Event by id
$route->addRoute('GET', '/api/event/:id', function($id) use ($dbConnection, $request, $response){
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    $response = $eventController->getEvent($id);
    header("Content-Type:". $response["headers"]["Content-Type"]);
    echo $response['body'];
});

//Insert a new event
$route->addRoute('POST', '/api/event', function() use ($dbConnection, $request, $response){
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    $response = $eventController->addEvent();
    header("Content-Type:". $response["headers"]["Content-Type"]);
    echo $response['body'];
});


//Update a new event
$route->addRoute('POST', '/api/event/:id', function($id) use ($dbConnection, $request, $response){
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    $response = $eventController->editEvent($id);
    header("Content-Type:". $response["headers"]["Content-Type"]);
    echo $response['body'];
});

//Delete an Event
$route->addRoute('DELETE','/api/event/:id', function($id) use ($dbConnection, $request, $response) {
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    $response = $eventController->deleteEvent($id);
    header("Content-Type:". $response["headers"]["Content-Type"]);
    echo $response['body'];
});

$route->dispatch();