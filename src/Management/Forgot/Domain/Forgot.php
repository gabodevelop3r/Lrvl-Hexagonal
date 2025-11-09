<?php

namespace Src\Management\Forgot\Domain;

use Src\Management\Forgot\Domain\Exceptions\MailFailedException;
use Src\Shared\Domain\Domain;
use Src\Shared\Domain\Helper\HttpCodesDomainHelper;

final class Forgot extends Domain{

    use HttpCodesDomainHelper;

    const MAIL_NOT_SENT = 'MAIL_NOT_SENT';
    protected function isException(string|null $exception): void
    {
        if($exception){
            match($exception){
                self::MAIL_NOT_SENT => throw new MailFailedException('Email Failed', $this->internalError()),
            };
        }
    }


}
