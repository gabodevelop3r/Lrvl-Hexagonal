<?php

namespace Src\Management\Login\Domain\Contracts;

use Src\Management\Login\Domain\ValueObjects\LoginAuthenticationParameters;
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

interface LoginAuthenticationContract
{
    public function auth(LoginAuthenticationParameters $loginAuthentication): string;

    public function check(LoginJwt $loginJwt) : bool;

    public function get(LoginJwt $loginJwt) : mixed;
}
