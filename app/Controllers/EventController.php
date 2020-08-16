<?php
namespace App\Controllers;

use App\Event\Event;
use App\Controllers\Response;

class EventController
{
    private $db;
    private $eventId;
    private $event;
    private $response;

    public function __construct($db)
    {
        $this->db = $db;
        $this->event = new Event($this->db);
        $this->response = new Response();
    }

    public function getAllEvent() 
    {
        $result = $this->event->findAll();
        return $this->createJsonResponse($result, 200);
    }

    public function getEvent($id)
    {
        $result = $this->event->find($id);
        return $this->createJsonResponse($result, 200);
    }
}
