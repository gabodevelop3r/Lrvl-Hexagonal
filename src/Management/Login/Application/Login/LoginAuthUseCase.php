<?php

namespace Src\Management\Login\Application\Login;

use Src\Management\Login\Application\Auth\LoginAuthenticationUseCase;
use Src\Management\Login\Domain\Contracts\LoginRepositoryContract;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginAuthentication;

final class LoginAuthUseCase
{

    public function __construct(
        private LoginRepositoryContract $loginRepository,
        private LoginAuthenticationUseCase $loginAuthenticationUseCase
    )
    {

    }

    public function __invoke(array $request):Login
    {
        $login = $this->loginRepository->login(new LoginAuthentication($request));

        $jwt = $this->loginAuthenticationUseCase->__invoke($login->handler());

        return new Login(array_merge($login->handler(), ['jwt'=> $jwt]));
    }

}
