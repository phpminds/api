<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Event;
use App\Util\DateUtc;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @template TEntityClass of object
 * @extends \Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository<TEntityClass>
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

    /**
     * @return array<int, Event>
     */
    public function fetchPastEvents(): array
    {
        $qb = $this->createQueryBuilder('e');
        $qb = $qb
            ->where('e.meetupDate < :meetup_date')
            ->setParameter('meetup_date', DateUtc::now())
            ->getQuery();

        return $qb->execute();
    }

    public function fetchLatestEvent(): ?Event
    {
        $qb = $this->createQueryBuilder('e');
        $qb = $qb
            ->where('e.meetupDate >= :meetup_date')
            ->setParameter('meetup_date', DateUtc::now())
            ->setMaxResults(1)
            ->getQuery();

        $result = $qb->execute();

        if (0 === count($result)) {
            return null;
        }

        return $result[0];
    }

    /**
     * @param Event $latestEvent
     *
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function save(Event $latestEvent): void
    {
        $this->_em->persist($latestEvent);
        $this->_em->flush();
    }
}
