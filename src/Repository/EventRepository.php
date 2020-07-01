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
     * @return Event[]
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
}
