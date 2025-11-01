<?php

namespace Src\Application\User\Domain;

use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helper\HttpCodesDomainHelper;

class User extends Domain {

    private const USER_NOT_FOUND = 'USER_NOT_FOUND';

    use HttpCodesDomainHelper;


    public function __construct(mixed $entity = null, readonly ?string $exception = null)
    {
        parent::__construct($entity, $exception);
    }

    public function handler(): array
    {
        return [
            'id' => $this->entity()['id'],
            'first_name' => $this->entity()['first_name'],
            'last_name' => $this->entity()['last_name'],
            'email' => $this->entity()['email'],
        ];
    }

    protected function isException(string|null $exception): void
    {
        if($exception){
            match($exception){
                self::USER_NOT_FOUND => throw new \Exception('User not found', $this->badRequest())
            };
        }
    }
}
