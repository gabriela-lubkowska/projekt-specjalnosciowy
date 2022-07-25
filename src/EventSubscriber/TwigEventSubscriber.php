<?php

namespace App\EventSubscriber;

use App\Repository\KategoriaRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private $twig;
    private $kategoriaRepository;

    public function __construct(Environment $twig, KategoriaRepository $kategoriaRepository)
    {
        $this->twig = $twig;
        $this->kategoriaRepository = $kategoriaRepository;
    }
    public function onKernelController(ControllerEvent $event): void
    {
        $this->twig->addGlobal('kategorie', $this->kategoriaRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            'kernel.controller' => 'onKernelController',
        ];
    }
}
