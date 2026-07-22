<?php

namespace App\Repository;

use App\Entity\Supplement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Supplement>
 */
class SupplementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Supplement::class);
    }
    public function searchByName(string $query): array
    {
        if (empty($query)) {
            return [];
        }
    
        return $this->createQueryBuilder('p')
            ->andWhere('LOWER(p.name) LIKE :query')
            ->setParameter('query', '%' . mb_strtolower($query) . '%')
            ->orderBy('p.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findExactByName(string $name): ?Supplement
    {
        return $this->createQueryBuilder('s')
            ->where('LOWER(s.name) = LOWER(:name)')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByBenefit(string $benefitQuery): array
    {
        return $this->createQueryBuilder('s')
            ->innerJoin('s.supplementbenefit', 'b')   
            ->where('LOWER(b.name) LIKE :query')
            ->setParameter('query', '%' . mb_strtolower($benefitQuery) . '%')
            ->orderBy('s.name', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
