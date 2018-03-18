<?php

namespace App\EventSubscriber;

use App\Entity\Product;
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

    public function onProductCreated(GenericEvent $event): void
    {
        /** @var Product $product */
        $product = $event->getSubject();

        $this->notificationSender->send(
            'New product',
            'fake@example.com',
            $this->templating->render('emails/new_product.html.twig', [
                'product' => $product,
            ])
        );
    }
}
