<?php

namespace App\EventSubscriber;

use App\Events;
use App\Utils\NotificationSenderInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\Templating\EngineInterface;

class ProductSubscriber implements EventSubscriberInterface
{
    private $notificationSender;
    private $templating;

    public function __construct(NotificationSenderInterface $notificationSender, EngineInterface $templating)
    {
        $this->notificationSender = $notificationSender;
        $this->templating = $templating;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            Events::PRODUCT_CREATED => 'onProductCreated',
        ];
    }

    public function onProductCreated(GenericEvent $event)
    {
        $product = $event->getSubject();

        $this->notificationSender->send(
            'subject',
            'fake@example.com',
            $this->templating->render('')
        );
    }
}
