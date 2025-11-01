<?php

namespace Src\Management\Login\Domain;

use Src\Management\Login\Domain\Exceptions\NotLoginException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helper\HttpCodesDomainHelper;

final class Login extends Domain{

    use HttpCodesDomainHelper;
    private const USER_NOT_FOUND = 'USER_NOT_FOUND';

    private const ID_ROLE_DEFAULT = 2;
    private const NAME_ROLE_DEFAULT = 'natural';

    private const ALL_ROLES_ALLOWED = '*';

    private bool $checkRole;

    public function __construct(mixed $entity = null, readonly ?string $exception = null)
    {
        parent::__construct($entity, $exception);

        $this->checkRole = $this->isUserCheckRole();
    }

    public function handler(): array
    {
        return [
            'id' => $this->entity()['id'],
            'first_name' => $this->entity()['first_name'],
            'email' => $this->entity()['email'],
            'roles' => $this->getRole(),
        ];
    }

    private function getRole() : array
    {
        $role = @$this->entity()['roles'][0] ?? [];

        return [
            'id' => @$role['id'] ?? self::ID_ROLE_DEFAULT,
            'name' => $role['name'] ?? self::NAME_ROLE_DEFAULT,
        ];

    }
    protected function isException(string|null $exception): void
    {
        if($exception){
            match($exception){
                self::USER_NOT_FOUND => throw new NotLoginException('Email or password incorrect', $this->badRequest()),
            };
        }
    }

    public function isUserCheckRole(): bool
    {
        if(!array_key_exists('user', $this->entity()) || !array_key_exists('type_role', $this->entity()))
            return true;

        if(is_array($this->entity()['type_role']) ){
            if($this->typeRoleExists())
                return true;

            if(in_array(self::ALL_ROLES_ALLOWED ,$this->entity()['type_role'] ))
                return true;

            return false;
        }

        return true;

    }

    private function typeRoleExists(): bool
    {
        return in_array($this->entity()['user']->roles->name, $this->entity()['type_role']);
    }


    public function getCheckRole() : bool
    {
        return $this->checkRole;
    }

}
