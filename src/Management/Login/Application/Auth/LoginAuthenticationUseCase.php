<?php

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginAuthenticationParameters;

final class LoginAuthenticationUseCase
{
    public function __construct(
        private readonly LoginAuthenticationContract $loginAuthentication
    )
    {

    }
    public function __invoke(array $loginData) : string
    {
        return $this->loginAuthentication->auth(new LoginAuthenticationParameters($loginData));
    }
}
