<?php

namespace Src\Shared\Domain\Exceptions;
use Exception;

abstract class CustomException extends Exception
{
    public function toException() : array
    {
        $classTmp = new \ReflectionClass(get_class($this));
        $class = explode('\\', $classTmp->getName());

        return [
            'status' => $this->getCode(),
            'error' => true,
            'class' => end($class),
            'message' => $this->getMessage()
        ];
    }
}
