<?php

namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => 'handleException'
        ];
    }

    public function handleException(ExceptionEvent $event)
    {
        $response =  new JsonResponse([
            'success' => false,
            'message' => $event->getThrowable()->getMessage()
        ], 500);

        $event->setResponse($response);
    }
}