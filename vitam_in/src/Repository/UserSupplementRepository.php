<?php

namespace App\Repository;

use App\Entity\UserSupplement;
use app\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserSupplement>
 */
class UserSupplementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserSupplement::class);
    }

       /**
        * @return UserSupplement[] Returns an array of UserSupplement objects 
        */
       public function findByUser(User $user): array
    {
        return $this->createQueryBuilder('us')
            ->andWhere('us.user = :user')
            ->setParameter('user', $user)
            ->orderBy('us.start_date', 'DESC')
            ->getQuery()
            ->getResult();
    }

}
