<?php
require_once __DIR__.'/app/bootstrap.php';

$route->addRoute('GET', '/api/users', function() use ($dbConnection, $request, $response) {
    $userController = new App\Controllers\UserController($dbConnection, $request, $response);
    return $userController->getAllUser();
});

$route->addRoute('GET', '/api/user/:id', function($id) use ($dbConnection, $request, $response) {
    $userController = new App\Controllers\UserController($dbConnection, $request, $response);
    return $userController->getUser($id);
});

//Get all Event
$route->addRoute('GET', '/api/events', function() use ($dbConnection, $request, $response){
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    return $eventController->getAllEvent();
});

//Get an Event by id
$route->addRoute('GET', '/api/event/:id', function($id) use ($dbConnection, $request, $response){
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    return $eventController->getEvent($id);
});

//Insert a new event
$route->addRoute('POST', '/api/event', function() use ($dbConnection, $request, $response){
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    return $eventController->addEvent();
});


//Update a new event
$route->addRoute('POST', '/api/event/:id', function($id) use ($dbConnection, $request, $response){
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    return $eventController->editEvent($id);
});

//Delete an Event
$route->addRoute('DELETE','/api/event/:id', function($id) use ($dbConnection, $request, $response) {
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    return $eventController->deleteEvent($id);
});

//Delete all Events
$route->addRoute('DELETE','/api/event', function() use ($dbConnection, $request, $response) {
    $eventController = new App\Controllers\EventController($dbConnection, $request, $response);
    return $eventController->deleteAllEvent();
});

$route->dispatch();