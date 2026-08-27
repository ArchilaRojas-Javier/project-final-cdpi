<?php

namespace App\Repository;

use App\Entity\Note;
use App\Entity\UserSupplement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Note>
 */
class NoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Note::class);
    }

    

    /**
     * @return Note[] Returns an array of Note objects
     */
    public function findByUserSupplement(UserSupplement $userSupplement): array
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.userSupplement = :userSupplement')
            ->setParameter('userSupplement', $userSupplement)
            ->orderBy('n.created_at', 'DESC')  
            ->getQuery()
            ->getResult();
    }

    
}
