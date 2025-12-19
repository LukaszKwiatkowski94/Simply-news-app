<?php

declare(strict_types=1);

namespace APP;

final class Request
{
    private array $requestGet;
    private array $requestPost;

    public function __construct()
    {
        $this->requestGet = $_GET;
        $this->requestPost = $_POST;
    }

    public function getRequestGet(): array
    {
        return $this->requestGet ?? [];
    }

    public function getRequestPost(): array
    {
        return $this->requestPost ?? [];
    }
}
