<?php

namespace Src\Shared\Infrastructure\Middleware;
use Illuminate\Http\Request;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Closure;
use Src\Shared\Infrastructure\Exceptions\AuthException;
use Src\Management\Login\Application\Auth\LoginRoleAuthenticationUseCase;

final class RoleMiddleware
{
    use HttpCodesHelper;

    public function __construct(private readonly LoginRoleAuthenticationUseCase $loginRoleAuthenticationUseCase)
    {

    }


    public function handle(Request $request, Closure $next,...$roles): mixed
    {

        if(empty($request->header('authentication')))
            throw new AuthException('Not jwt auth', $this->badRequest());

        $authentication = $request->header('authentication');

        $check = $this->loginRoleAuthenticationUseCase->__invoke($authentication, $roles);

        if(!$check)
            throw new AuthException('Role is not valid', $this->unathorized());

        return $next($request);
    }

    public function getMiddlewareRole($request){

        $routeMiddleware = $request->route()->controllerMiddleware() ?? [];

        return $routeMiddleware[0]['options']['role'] ?? '*';

    }



}
