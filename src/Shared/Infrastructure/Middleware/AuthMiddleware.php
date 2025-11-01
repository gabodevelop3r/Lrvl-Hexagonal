<?php

namespace Src\Shared\Infrastructure\Middleware;
use Illuminate\Http\Request;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Closure;
use Src\Shared\Infrastructure\Exceptions\AuthException;
use Src\Management\Login\Application\Auth\LoginCheckAuthenticationUseCase;

final class AuthMiddleware
{
    use HttpCodesHelper;

    public function __construct(private readonly LoginCheckAuthenticationUseCase $loginCheckAuthenticationUseCase)
    {

    }


    public function handle(Request $request, Closure $next): mixed
    {
        if(empty($request->header('authentication')))
            throw new AuthException('Not jwt auth', $this->badRequest());

        $check = $this->loginCheckAuthenticationUseCase->__invoke($request->header('authentication'));

        if(!$check)
            throw new AuthException('Invalid token or invalid user or expired token', $this->badRequest());


        return $next($request);
    }



}
