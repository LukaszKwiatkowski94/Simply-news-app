<?php

declare(strict_types=1);

namespace APP\Classes;

abstract class AbstractClass
{
    abstract public function fromArray(array $data): self;
    abstract public function toArray(): array;
    abstract public function toJson(): string;
}
