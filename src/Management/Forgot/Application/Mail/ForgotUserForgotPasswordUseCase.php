<?php

namespace Src\Management\Forgot\Application\Mail;
use Src\Management\Forgot\Domain\Contracts\ForgotMailableContract;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable;

final class ForgotUserForgotPasswordUseCase
{

    public function __construct(private ForgotMailableContract $forgotMailable)
    {

    }

    public function __invoke(array $request): mixed
    {
        return $this->forgotMailable->forgotSendMail(new ForgotMailable($request['email']))->entity();
    }
}
