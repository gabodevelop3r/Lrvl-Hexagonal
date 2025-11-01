<?php

namespace Src\Application\User\Infrastructure\Controllers;
use Src\Shared\Infrastructure\Controllers\CustomController;
use Src\Shared\Infrastructure\Helper\HttpCodesHelper;
use Illuminate\Http\JsonResponse;
use Src\Shared\Infrastructure\Middleware\RoleMiddleware;
use Src\Application\User\Application\GetUser\GetUserUseCase;

final class GetUserController extends CustomController
{
    use HttpCodesHelper;

    public function __construct(private GetUserUseCase $getUserUseCase)
    {
        $this->middleware(RoleMiddleware::class . ':super_admin');
    }

    public function __invoke(int $userId):JsonResponse
    {
        $user = $this->getUserUseCase->__invoke($userId);

        return $this->jsonResponse(
            $this->ok(),
            false,
            $user
        );
    }

}
