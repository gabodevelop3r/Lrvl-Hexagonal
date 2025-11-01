<?php
namespace Src\Shared\Infrastructure\Middleware;

use Illuminate\Http\Request;
use Closure;
use Src\Shared\Infrastructure\Exceptions\ApiAuthException;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;


final class ApiMiddleware
{
    use HttpCodesHelper;
    public function handle(Request $request, Closure $next): mixed
    {
        if(empty($request->header('authorization')))
            throw new ApiAuthException('Not auth authorization header', $this->badRequest());

        if(env('API_KEY') != $request->header('authorization'))
            throw new ApiAuthException('Invalid API Key', $this->badRequest());

        return $next($request);
    }


}
