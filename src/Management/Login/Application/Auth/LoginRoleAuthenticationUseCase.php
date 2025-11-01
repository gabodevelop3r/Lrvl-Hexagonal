<?php

namespace Src\Management\Login\Application\Auth;

use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginRoleAuthenticationUseCase {

    public function __construct(private readonly LoginAuthenticationContract $loginAuthentication)
    {

    }

    public function __invoke(string $jwt, string|array $role)
    {

       $login = new Login([
                            'user'=> $this->loginAuthentication->get(new LoginJwt($jwt)),
                            'type_role' => $role
                        ]);

       return $login->getCheckRole();
    }
}

