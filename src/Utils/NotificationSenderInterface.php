<?php

namespace App\Utils;

interface NotificationSenderInterface
{
    public function send(string $subject, string $to, string $body): void;
}
