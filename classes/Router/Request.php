<?php
namespace Classes\Router;

use Classes\Router\IRequest;

class Request implements IRequest
{
    public function __construct()
    {
        $this->bootstrapSelf();
    }

    private function bootstrapSelf()
    {
        foreach ($_SERVER as $key => $value) {
            $this->{$this->toCamelCase($key)} = $value;
        }
    }

    private function toCamelCase($string)
    {
        $result = strtolower($string);

        preg_match_all('/_[a-z]/', $result, $matches);

        foreach ($matches[0] as $match) {
            $c = str_replace('_', '', strtoupper($match));
            $result = str_replace($match, $c, $result);
        }

        return $result;
    }

    public function getHeader($header)
    {
        $headers = getallheaders();
        return $headers[$header];
    }

    public function getBody()
    {
        $sentData = null;
        $contentType = $this->getHeader("Content-Type");

        if ($this->requestMethod === "GET") {
            $sentData = $_GET;
        }

        if ($this->requestMethod == "POST") {
            $sentData = $_POST;
            if ($contentType === 'application/json') {
                return json_decode(file_get_contents('php://input'),true);
            }
        }

        $body = array();
        foreach ($sentData as $key => $value) {
            $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        return $body;
    }
}
