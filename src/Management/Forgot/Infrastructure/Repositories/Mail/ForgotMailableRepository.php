<?php

namespace Src\Management\Forgot\Infrastructure\Repositories\Mail;
use Src\Management\Forgot\Domain\Contracts\ForgotMailableContract;
use Src\Management\Forgot\Domain\Forgot;
use Src\Management\Forgot\Domain\ValueObjects\ForgotMailable;
use Illuminate\Support\Facades\Mail;
class ForgotMailableRepository implements ForgotMailableContract {

    public function __construct(private Mail $mail){

    }

    public function forgotSendMail(ForgotMailable $forgotMailable) : Forgot
    {
        $response = $this->mail::to($forgotMailable->value())
                                ->send(new CustomMail($forgotMailable->getObjectMailable()));

        if(!$response)
            return new Forgot(null, 'MAIL_NOT_SENT');

        return new Forgot(['email' => $forgotMailable->value(), 'custom' => 'mensaje enviado'] );
    }

}
