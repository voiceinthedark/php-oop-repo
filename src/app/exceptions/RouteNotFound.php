<?php

namespace app\exceptions;

class RouteNotFound extends \Exception
{
    public function __construct(string $message = "Route not found", int $code = 404)
    {
        parent::__construct($message, $code);
    }
}