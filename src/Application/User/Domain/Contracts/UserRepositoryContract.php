<?php

namespace Src\Application\User\Domain\Contracts;
use Src\Application\User\Domain\User;

interface UserRepositoryContract {

    public function find(int $id): User;

}
