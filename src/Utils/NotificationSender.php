<?php

namespace App\Utils;

use Swift_Mailer;
use Swift_Message;

class NotificationSender implements NotificationSenderInterface
{
    private $mailer;

    public function __construct(Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(string $subject, string $to, string $body): void
    {
        $this->mailer->send(
            (new Swift_Message($subject))
                ->setFrom()
                ->setTo($to)
                ->setBody()
        );
    }
}
