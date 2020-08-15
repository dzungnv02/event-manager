<?php
namespace Classes\Router;

interface IRequest
{
    public function getBody();
    public function getHeader($header);
}
