<?php

namespace Src\Management\Login\Domain\Contracts;

use Src\Management\Login\Domain\Login;
use Src\Management\Login\Domain\ValueObjects\LoginAuthentication;

interface LoginRepositoryContract
{
    public function login(LoginAuthentication $loginAuthentication): Login;
}
