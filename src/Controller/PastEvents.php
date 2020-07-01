<?php

declare(strict_types=1);

namespace App\Controller;

use App\Event\EventsInterface;
use App\Transformer\TransformerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class PastEvents extends AbstractController
{
    /**
     * @Route("/events/past", name="past_events", methods={"GET"})
     *
     * @param EventsInterface      $events
     * @param TransformerInterface $transformer
     *
     * @return JsonResponse
     */
    public function getPastEvents(EventsInterface $events, TransformerInterface $transformer): JsonResponse
    {
        return new JsonResponse($transformer->transform($events->getPastEvents()));
    }
}
