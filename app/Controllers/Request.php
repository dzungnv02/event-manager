<?php
namespace App\Controllers;

class Request {
    protected $requestContentType;
    protected $requestBody;
    protected $requestHeaders;
    protected $contentType = [
        'text' => 'text/plain',
        'html' => 'text/html',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'download' => 'application/octet-stream',
        'multipart' => 'multipart/form-data',
    ];

    public function __construct() 
    {
        $this->requestHeaders = getallheaders();
    }

    public function get($key)
    {
        return !empty($this->requestBody[$key]) ? $this->requestBody[$key] : null;
    }

    public function getAll()
    {
        $this->requestBody = $this->requestBodyParser();
        return $this->requestBody;
    }

    public function getHeader($header)
    {
        return !empty($this->requestHeaders[$header]) ? $this->requestHeaders[$header] : null;
    }

    private function requestBodyParser()
    {
        $contentType = $this->getHeader('Content-Type');
        if ($contentType === $this->contentType['json']) {
            $requestBody = json_decode (file_get_contents('php://input'), true);
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $requestBody = $_POST;
        }
        else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            $requestBody = $_GET;
        }

        return $requestBody;
    }
}