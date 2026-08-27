<?php

namespace App\Repository;

use App\Entity\Reminder;
use App\Entity\UserSupplement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reminder>
 */
class ReminderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reminder::class);
    }

    public function findActiveByUserSupplement(UserSupplement $userSupplement): ?Reminder
    {
        return $this->createQueryBuilder('r')
            ->where('r.userSupplement = :userSupplement')
            ->andWhere('r.is_active = :active')
            ->setParameter('userSupplement', $userSupplement)
            ->setParameter('active', true)
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    //    public function findOneBySomeField($value): ?Reminder
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
