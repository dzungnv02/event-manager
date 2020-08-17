<?php
namespace App\Controllers;

use App\Event;

class EventController
{
    private $db;
    protected $request;
    protected $response;
    private $event;

    public function __construct($db, Request $request, Response $response)
    {
        $this->db = $db;
        $this->request = $request;
        $this->response = $response;
        $this->event = new Event($this->db);
    }

    public function getAllEvent() 
    {
        $result = $this->event->findAll();
        return $this->response->createJsonResponse($result);
    }

    public function getEvent($id)
    {
        $result = $this->event->find($id);
        return $this->response->createJsonResponse($result);
    }

    public function addEvent()
    {
        $inputs = $this->request->getAll();
        $result = $this->event->insert($inputs);
        return $this->response->createJsonResponse(['RESULT' => $result > 0 ? 'OK':'FAILED', 'NEW_ID' => $result], 201);
    }

    public function editEvent($id)
    {
        $inputs = $this->request->getAll();
        $result = $this->event->update($id, $inputs);
        return $this->response->createJsonResponse(['RESULT' => $result > 0 ? 'OK':'FAILED']);
    }

    public function deleteEvent($id)
    {
        $result = $this->event->delete($id);
        return $this->response->createJsonResponse(['RESULT' => $result > 0 ? 'OK':'FAILED', 'AFFECTED' => $result]);
    }

    public function deleteAllEvent()
    {
        $result = $this->event->deleteAll();
        return $this->response->createJsonResponse(['RESULT' => $result > 0 ? 'OK':'FAILED', 'AFFECTED' => $result]);
    }
}
