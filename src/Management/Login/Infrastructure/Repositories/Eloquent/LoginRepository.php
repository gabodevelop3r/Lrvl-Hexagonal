<?php

namespace Src\Management\Login\Infrastructure\Repositories\Eloquent;

use Src\Management\Login\Infrastructure\Repositories\Eloquent\User as Model;
use Src\Management\Login\Domain\Contracts\LoginRepositoryContract;
use Src\Management\Login\Domain\ValueObjects\LoginAuthentication;
use Src\Management\Login\Domain\Login;

final class LoginRepository implements LoginRepositoryContract
{
    public function __construct(private Model $model)
    {


    }
    public function login(LoginAuthentication $loginAuthentication): Login
    {
        $user = $this->userByEmail($loginAuthentication->value()['email']);

        if(!$user)
            return new Login(null, 'USER_NOT_FOUND');

        $check = $loginAuthentication->checkPassword($loginAuthentication->value()['password'], $user['password']);

        if(!$check)
            return new Login(null, 'USER_NOT_FOUND');

        return new Login($user);
    }

    private function userByEmail(string $email): ? array
    {
        $user = $this->model->with('roles')->where('email', $email)->select('id','first_name', 'email', 'password')->first();

        return $user?->makeVisible('password')->toArray();
    }

}
