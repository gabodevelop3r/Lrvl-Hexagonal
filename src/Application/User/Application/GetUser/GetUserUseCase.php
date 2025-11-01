<?php

namespace Src\Application\User\Application\GetUser;

use Src\Application\User\Domain\Contracts\UserRepositoryContract;
use Src\Application\User\Domain\User;

final class GetUserUseCase {

    public function __construct(private UserRepositoryContract $userRepository ) {

    }

    public function __invoke(int $userId): array
    {
        $user = $this->userRepository->find($userId);

        return $user->handler();
    }

}
