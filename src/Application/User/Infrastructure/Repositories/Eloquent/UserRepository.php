<?php

namespace Src\Application\User\Infrastructure\Repositories\Eloquent;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;
use Src\Application\User\Infrastructure\Repositories\Eloquent\Models\User as EloquentUser;

class UserRepository implements UserRepositoryContract {


    public function __construct(private EloquentUser $model){}

    public function find(int $id) : User {

        $user = $this->model->find($id);

        if($user)
            return new User($user);

        return new User(null, 'USER_NOT_FOUND');

    }
}
