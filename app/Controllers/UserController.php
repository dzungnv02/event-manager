<?php
namespace App\Controllers;

use App\User;

class UserController 
{
    private $db;
    protected $request;
    protected $response;
    protected $user;

    public function __construct($db, Request $request, Response $response)
    {
        $this->db = $db;
        $this->request = $request;
        $this->response = $response;
        $this->user = new User($this->db);
    }

    public function getAllUser()
    {
        $result = $this->user->findAll();
        return $this->response->createJsonResponse($result);
    }

    public function getUser($id)
    {
        $result = $this->user->find($id);
        return $this->response->createJsonResponse($result);
    }

    public function addUser()
    {
        $inputs = $this->request->getAll();
        $result = $this->user->insert($inputs);
        return $this->response->createJsonResponse(['RESULT' => $result > 0 ? 'OK':'FAILED']);
    }
}