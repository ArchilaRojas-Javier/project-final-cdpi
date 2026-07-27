<?php

namespace App\Repository;

use App\Entity\Supplement;
use App\Entity\SupplementType;
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
    public function searchByName(string $query, ?SupplementType $type = null): array
    {
        if (empty($query)) {
            return [];
        }
    
        $qb = $this->createQueryBuilder('p')
        ->andWhere('LOWER(p.name) LIKE :query')
        ->setParameter('query', '%' . mb_strtolower($query) . '%')
        ->orderBy('p.name', 'ASC');

        if ($type) {
            $qb->andWhere('p.supplementtype = :type')
           ->setParameter('type', $type);
        }

    return $qb->getQuery()->getResult();
    }

    public function findExactByName(string $name, ?SupplementType $type = null): ?Supplement
    {
        $qb = $this->createQueryBuilder('s')
        ->where('LOWER(s.name) = LOWER(:name)')
        ->setParameter('name', $name);

        if ($type) {
            $qb->andWhere('s.supplementtype = :type')
            ->setParameter('type', $type);
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function findByBenefit(string $benefitQuery, ?SupplementType $type = null ): array
    {
        $qb = $this->createQueryBuilder('s')
        ->innerJoin('s.supplementbenefit', 'b')
        ->where('LOWER(b.name) LIKE :query')
        ->setParameter('query', '%' . mb_strtolower($benefitQuery) . '%')
        ->orderBy('s.name', 'ASC');

        if ($type) {
            $qb->andWhere('s.supplementtype = :type')
            ->setParameter('type', $type);
        }

        return $qb->getQuery()->getResult();
    }
}
