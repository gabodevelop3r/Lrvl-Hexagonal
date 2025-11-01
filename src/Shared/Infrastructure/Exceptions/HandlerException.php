<?php

namespace Src\Shared\Infrastructure\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Src\Shared\Domain\Exceptions\CustomException;

class HandlerException extends ExceptionHandler
{
    public function register(): void
    {
        $this->renderable(function (Throwable $e){
            if($e instanceof CustomException)
                return response()->json($e->toException(), $e->getCode());

        });
    }
}
