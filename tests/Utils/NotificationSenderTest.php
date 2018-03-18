<?php

namespace App\Tests\Utils;

use App\Utils\NotificationSender;
use PHPUnit\Framework\TestCase;

class NotificationSenderTest extends TestCase
{
    public function testSend(): void
    {
        $mailer = $this->createMock(\Swift_Mailer::class);
        $mailer->expects($this->once())->method('send');
        $notificationSender = new NotificationSender($mailer);
        $notificationSender->send('subject', 'test@test.xdev', 'body');
    }
}
