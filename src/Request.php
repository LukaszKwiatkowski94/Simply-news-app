<?php

declare(strict_types=1);

namespace APP;

class Request
{
    private array $requestGet;
    private array $requestPost;

    public function __construct($requestGet, $requestPost)
    {
        $this->requestGet = $requestGet;
        $this->requestPost = $requestPost;
    }

    public function getRequestGet() : array
    {
        return $this->requestGet ?? [];
    }

    public function getRequestPost() : array
    {
        return $this->requestPost ?? [];
    }
}