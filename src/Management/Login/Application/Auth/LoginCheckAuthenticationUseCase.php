<?php

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginCheckAuthenticationUseCase {

    public function __construct(private readonly LoginAuthenticationContract $loginAuthentication)
    {

    }

    public function __invoke(string $jwt):bool
    {
        return $this->loginAuthentication->check(new LoginJwt($jwt));
    }

}
