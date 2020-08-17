<?php
namespace App\Controllers;

class Response
{
    protected $statusCodeHeader = [
        200 => 'HTTP/1.1 200 OK',
        201 => 'HTTP/1.1 201 Created',
        202 => 'HTTP/1.1 202 Accepted',
        404 => 'HTTP/1.1 404 Not Found',
        500 => 'HTTP/1.1 500 Server Error',
    ];

    protected $contentType = [
        'text' => 'text/plain',
        'html' => 'text/html',
        'json' => 'application/json',
        'xml' => 'application/xml',
        'download' => 'application/octet-stream',
    ];

    public function createJsonResponse($body, $statusCode = 200)
    {
        return $this->createResponse(json_encode($body), 'json', $statusCode);
    }

    public function createResponse($body, $contentType, $statusCode)
    {
        return ['body' => $body,
            'headers' => [
                'Content-Type' => $this->contentType[$contentType],
                'status_code' => $this->statusCodeHeader[$statusCode],
            ],
        ];
    }
}
