<?php

declare(strict_types=1);

namespace App\Controller;

use App\Event\EventsInterface;
use App\Transformer\TransformerInterface;
use App\Event\Client\EventClientInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class LatestEvent extends AbstractController
{
    /**
     * @Route("/events/latest", name="latest_event", methods={"GET"})
     *
     * @param EventsInterface      $events
     * @param TransformerInterface $transformer
     *
     * @return JsonResponse
     */
    public function getLatestEvent(EventsInterface $events, TransformerInterface $transformer): JsonResponse
    {
        $latestEvent = $events->getLatestEvent();
        if (!$latestEvent instanceof EventClientInterface) {
            return new JsonResponse(['error' => 'No latest event found.'], Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse($transformer->transform([$latestEvent]));
    }
}
