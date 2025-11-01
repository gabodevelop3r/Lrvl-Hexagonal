<?php

namespace Src\Shared\Domain;

abstract class Domain
{
    public function __construct(private mixed $entity = null, private readonly ?string $exception = null)
    {
        $this->isException($this->exception);
    }


    public function entity(): mixed
    {
        return $this->entity;
    }

    protected abstract function isException(?string $exception): void;
}
