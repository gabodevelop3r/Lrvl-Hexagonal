<?php

namespace Src\Management\Login\Infrastructure\Repositories\FirebaseJwt;
use Src\Management\Login\Domain\Contracts\LoginAuthenticationContract;
use Src\Management\Login\Domain\ValueObjects\LoginAuthenticationParameters;
use Firebase\JWT\{JWT,ExpiredException,Key };
use Src\Management\Login\Domain\ValueObjects\LoginJwt;

final class LoginAuthentication implements LoginAuthenticationContract
{
    public function __construct(private JWT $jwt)
    {
    }

    public function auth(LoginAuthenticationParameters $loginAuthenticationParameters): string
    {
        return $this->jwt::encode(
            $loginAuthenticationParameters->handler(),
            $loginAuthenticationParameters->jwtKey(),
            $loginAuthenticationParameters->jwtEncrypt()
        );
    }

    public function check(LoginJwt $loginJwt) : bool
    {
        try {
            $decode = $this->jwt::decode(
                $loginJwt->value(),
                new Key($loginJwt->jwtKey(), $loginJwt->jwtEncrypt())
            );
            if(time() > $this->getTokenExpiredAt($decode))
                return false;

            return true;

        } catch (\Throwable $th) {
            return false;
        }
    }

    private function getTokenExpiredAt($decode)
    {
        return $decode?->exp;
    }


    public function get(LoginJwt $loginJwt): mixed
    {

        $decoded = $this->jwt::decode(
            $loginJwt->value(),
            new Key($loginJwt->jwtKey(), $loginJwt->jwtEncrypt())
        );

        return $decoded->data ?? null;

    }


}
